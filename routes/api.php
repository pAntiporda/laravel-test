<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentController;
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

// Create a new comment via the given post slug
Route::post('/posts/{post:slug}/comments', [PostCommentController::class, 'store'])->middleware('auth:sanctum');

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

Route::post('/newsletter', NewsletterController::class);

Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth:sanctum');

Route::get('/admin', function () {
    return 'Admin only';
})->middleware(['auth:sanctum', 'admin']);
// slug rule: [required, Rule::unique('posts', 'slug')->ignore($post)]
