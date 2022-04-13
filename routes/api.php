<?php

use App\Models\Post;
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
    return Post::all();
});

// Find the post by slug. Omitting ':slug' will default to finding the post via its id.
Route::get('/posts/{post:slug}', function (Post $post) {
    return Post::find($post);
});
