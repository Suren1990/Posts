<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Requests\Post\FilterRequest;
use App\Models\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class ModeratorController extends Controller
{
    public function index(Request $request, User $users)
    {
        $query = Post::filterByStatus($request->input('status'));
        if (auth()->user()->role !== 'admin') {
            $query->where('user_id', auth()->id());
        }
        $posts = $query->paginate(6);
        
        return view('moderator.index', compact('posts', 'users'));
    }

    public function show(Post $post){
        return view('moderator.show', compact('post'));
    }

    public function accept(Post $post){
        $post->status = 'accepted';
        $post->save();
        Notification::create([
            'user_id' => $post->user_id,
            'message' => "Your Post #{$post->title} is accepted with moderator.",
        ]);
        
        return redirect()->route('moderator.index');
    }

    public function reject(Request $request, Post $post){
        $request->validate([
            'moderator_comments' => 'nullable|string',
        ]);
        $post->update([
            'status' => 'rejected',
            'moderator_comments' => $request->input('moderator_comments'),
        ]);

        Notification::create([
            'user_id' => $post->user_id,
            'message' => "Your Post #{$post->title} is rejected with moderator. Comment: " . ($post->moderator_comments ?? ''),
        ]);
       
        return redirect()->route('moderator.index');
    }

    public function edit(Post $post){
        $tags = Tag::all();
        return view("moderator.edit", compact('post', 'tags'));
    }

    public function update(UpdateRequest $request, Post $post){
        $data = $request->validated();
        $post->updateModeratorRejectedPost($data);

        return redirect()->route('moderator.index');
    }
}

