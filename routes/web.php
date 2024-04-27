<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\mainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\EmailVerificationController;

// Search Routes
Route::get('/forums/search', [ForumController::class, 'search'])->name('forums.search');
Route::get('/forums/{forumId}/threads/filter', [ThreadController::class, 'filter'])->name('threads.filter');
Route::get('/forums/{ThreadId}/posts/filter', [PostController::class, 'filter'])->name('posts.filter');

// Reply Routes
Route::resource('/replies', ResponseController::class)->middleware(['throttle:8,1']);

// Index Routes
Route::get('/', [mainController::class, 'indexHome'])->name('home.index');
Route::get('/user/{id}/settings', [UserController::class, 'show'])->name('user.settings');
Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');
Route::get('/forums/{id}', [ForumController::class, 'show'])->name('forums.show');
Route::get('/forums/thread/{id}', [ThreadController::class, 'show'])->name('threads.show');
Route::get('/forums/threads/post/{id}', [PostController::class, 'show'])->name('posts.show');

// Auth Routes
Route::get('register', [AuthController::class, 'indexRegisterPage'])->middleware(AuthMiddleware::class)->name('register.index');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'indexLoginPage'])->middleware(AuthMiddleware::class)->name('login.index');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout', [AuthController::class, 'logout'])->middleware(AuthMiddleware::class)->name('logout');

Route::get('/forget-password', [AuthController::class, 'indexForgetPasswordForm'])->name('forget-password.index');
Route::post('/forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget-password');

Route::get('/reset-password/{token}', [AuthController::class, 'indexResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset-password');
Route::put('/update-password', [ProfileController::class, 'updatePassword'])->name('password.update');
Route::get("/posts/resource/fetch/{id}", [PostController::class, 'fetchPost'])->name('post.fetch');
Route::get("/threads/resource/fetch/{id}", [ThreadController::class, 'fetchThread'])->name('therad.fetch');
Route::get("/forums/resource/fetch/{id}", [ForumController::class, 'fetchForum'])->name('forum.fetch');
Route::middleware(['auth'])->group(function () {
    //Forum Routes
    Route::resource('/forums/resource', ForumController::class)->middleware(['throttle:8,1', 'can:manage,App\Models\Forum']);
    //stats
    Route::get('/statistics', [mainController::class, 'indexStats'])->middleware(['can:manage,App\Models\Forum'])->name("stats.show");
    //Post Routes
    Route::resource('/posts/resource', PostController::class)->middleware(['throttle:8,1']);
    //Thread Routes
    Route::resource('/threads/resource', ThreadController::class)->middleware(['throttle:8,1']);
    //Resource Routes
    Route::post("/replies/mark/{id}", [ResponseController::class, 'mark'])->name("response.mark");
    Route::post("/replies/unmark/{id}", [ResponseController::class, 'unmark'])->name("response.unmark");
    Route::get("/replies/responseCount/{id}", [ResponseController::class, 'count'])->name("response.count");
    //Votes
    Route::post("/replies/upvote/{id}", [ResponseController::class, 'upvote'])->name("response.upvote");
    Route::post("/replies/downvote/{id}", [ResponseController::class, 'downvote'])->name("response.downvote");
    Route::post("/posts/upvote/{id}", [PostController::class, 'upvote'])->name("post.upvote");
    Route::post("/posts/downvote/{id}", [PostController::class, 'downvote'])->name("post.downvote");
    //Auth Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/verify-email', [EmailVerificationController::class, 'store'])
        ->name('verification.notice');
    Route::get('/verify-email/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::get('/email/verification-notification', [EmailVerificationController::class, 'prompt'])
        ->middleware('throttle:6,1')
        ->name('verification.send');
});
