<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
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

Route::get('/posts', [PostController::class, 'index']);
// Find the post by slug. Omitting ':slug' will default to finding the post via its id.
Route::get('/posts/{post:slug}', [PostController::class, 'show']);

// Find all posts that belong to a category.
Route::get('/category/{category:slug}', function (Category $category) {
    // return $category->posts->load(['category', 'author']); // eager loads the category and author

    return $category->posts; // eager loads the category and author by default (see Post model)
});

// Find all posts that belong to an author via its username.
Route::get('/authors/{author:username}', function (User $author) {
    // return $author->posts->load(['category', 'author']); // eager loads the category and author

    return $author->posts; // eager loads the category and author by default (see Post model)
});

Route::post('/register', [RegisterController::class, 'store']);
