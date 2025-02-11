<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;

Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/articles/{article}', [HomeController::class, 'show'])->name('articles.show');

Route::middleware('guest')->group(function () {
    Route::view('/register','auth.register')->name('register');
    Route::post('/register',[AuthController::class,'register']);

    Route::view('/login','auth.login')->name('login');
    Route::post('/login',[AuthController::class,'login']);
});

Route::middleware('auth')->group(function (){
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/report', [CommentController::class, 'report'])->name('comments.report');
    Route::post('/comments/reply', [CommentController::class, 'reply'])->name('comments.reply');
});

Route::get('/symlink', function () {
    Artisan::call('storage:link');
});