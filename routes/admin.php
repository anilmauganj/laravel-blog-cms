<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('tags', TagController::class);
        Route::resource('posts', PostController::class);

        Route::resource('comments', CommentController::class)
                      ->only(['index', 'destroy']);

        Route::patch(
            'comments/{comment}/approve',
            [CommentController::class, 'approve']
          )->name('comments.approve');
          
    });