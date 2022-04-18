<?php

use App\Models\Post;
use App\Models\Category;
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
    return Post::with('category', 'user')->get(); // solving n+1 query problem
});

// Find the post by slug. Omitting ':slug' will default to finding the post via its id.
Route::get('/posts/{post:slug}', function (Post $post) {
    return Post::find($post);
});

// Find all posts that belong to a category.
Route::get('/category/{category:slug}', function (Category $category) {
    return $category->posts;
});
