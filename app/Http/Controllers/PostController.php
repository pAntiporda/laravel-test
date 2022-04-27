<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index ()
    {
        // all() gets all the records without any condition while get() is used in conjunction with conditions
        // return Post::all();
        // return Post::latest()->with('category', 'author')->get(); // solving n+1 query problem by eager loading (with).

        // return Post::latest()->without(['category', 'author'])->get(); // returns all the posts in descending order and without eager loading
        return Post::latest()->filter(request(['search', 'category']))->get();
    }

    public function show (Post $post)
    {
        return $post;
    }
}
