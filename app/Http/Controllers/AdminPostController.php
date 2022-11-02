<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminPostRequest;
use App\Http\Resources\AdminPostResource;
use App\Models\Post;

class AdminPostController extends Controller
{
    public function store(StoreAdminPostRequest $request)
    {
        $post = new Post;
        $post->user_id = $request->user()->id;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->excerpt = $request->excerpt;
        $post->save();

        return new AdminPostResource($post);
    }
}
