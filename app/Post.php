<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Category;
use App\Tag; 
use App\Post;

class Post extends Model
{
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function categories(){
    	return $this->belongsToMany(Category::class)->withTimeStamps();
    }

    public function tags(){
    	return $this->belongsToMany(Tag::class)->withTimeStamps();
    }

    public function favorite_to_users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
