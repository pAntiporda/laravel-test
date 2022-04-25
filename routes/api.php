<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the blog API.',
    ]);
});

Route::get('/posts', function () {
    // all() gets all the records without any condition while get() is used in conjunction with conditions
    // return Post::all();
    return Post::latest()->with('category', 'author')->get(); // solving n+1 query problem by eager loading (with).
});

// Find the post by slug. Omitting ':slug' will default to finding the post via its id.
Route::get('/posts/{post:slug}', function (Post $post) {
    return $post;
});

// Find all posts that belong to a category.
Route::get('/category/{category:slug}', function (Category $category) {
    return $category->posts;
});

// Find all posts that belong to an author via its username.
Route::get('/authors/{author:username}', function (User $author) {
    return $author->posts;
});
