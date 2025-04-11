<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $guarded = [];

    public function creator(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function updater(){

        return $this->belongsTo(User::class, 'updated_by');
    }

    protected static function boot(){
        parent::boot();
        static::creating(function ($post) {
            if (Auth::check()) {
                $post->user_id = Auth::id();
            }
        });

        static::updating(function ($post) {
            if (Auth::check()) {
                $post->updated_by = Auth::id();
            }
        });
    } 
    
    public function scopeByAuthor($query, $user_id){

        return $query->where('user_id', $user_id);
    }

    public function scopeSearch($query, $search){
        return $query->where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('post_content', 'like', '%' . $search . '%')
                ->orWhereHas('tags', function ($query) use ($search) {
                    $query->where('tags.title', 'like', '%' . $search . '%');
                });
        });
    }

    public function scopeFilterByStatus($query, $status = null)
    {
        if ($status) {
            return $query->where('status', $status);
        }
        return $query->whereIn('status', ['pending', 'rejected']);
    }

    public function tags(){

    return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public static function createPost(array $data){
        $post = self::create([
            'title' => $data['title'],
            'post_content' => $data['post_content']
        ]);
        if (isset($data['tags'])) {
            $post->tags()->attach($data['tags']);
        }

        return $post;
    }

    public function updatePost(array $data){

        $this->update([
            'title' => $data['title'],
            'post_content' => $data['post_content'],
        ]);

        if (isset($data['tags'])) {
            $this->tags()->sync($data['tags']);
        }
    }

    public function updateModeratorRejectedPost(array $data){

        $this->update([
            'title' => $data['title'],
            'post_content' => $data['post_content'],
            'status' => 'pending',
        ]);

        if (isset($data['tags'])) {
            $this->tags()->sync($data['tags']);
        }
    }
}
