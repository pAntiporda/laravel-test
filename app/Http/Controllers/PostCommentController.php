<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;

class PostCommentController extends Controller
{
    public function store(Post $post, StoreCommentRequest $request)
    {
        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = $request->user()->id;
        $post->comments()->save($comment);

        return new CommentResource($comment);
    }
}
