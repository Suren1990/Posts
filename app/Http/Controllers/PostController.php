<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Post\FilterRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(FilterRequest $request)
    {
    $users = User::all();
    $query = Post::query();
    $author = $request->filters()['author'] ?? null;
    $search = $request->filters()['search'] ?? null;
    if ($author) {
        $query->byAuthor($author);
    }
    if ($search) {
        $query->search($search);
    }
    $query->where('status', 'accepted');
    $posts = $query->paginate(6);
    
        return view('post.index', compact('posts', 'users'));
    }

    public function create()
    {
        $tags = Tag::all();
        
        return view('post.create', compact('tags'));
    }

    public function store(StoreRequest $request)
    {        
        $data = $request->validated();
        Post::createPost($data); 

        return redirect('posts');
    }

    public function show(Post $post)
    {
        return (Auth::user()->id == $post->creator->id) 
            ? view('post.show', compact('post')) 
                : redirect('posts');
    }

    public function edit(Post $post)
    {
        $tags = Tag::all();
        return (Auth::user()->id == $post->creator->id) 
            ? view('post.edit', compact('post', 'tags')) 
                : redirect('posts');     
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $post->updatePost($data);

        return redirect('posts');
    }

    public function destroy(Post $post){
        $post->delete();

        return redirect()->route('post.index');
    }
}

