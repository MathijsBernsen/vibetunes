<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes for regular users
    Route::resource('playlists', PlaylistController::class);
    Route::resource('events', EventController::class)->only(['index']);
    Route::resource('songs', SongController::class)->only(['index']);
    Route::resource('albums', AlbumController::class)->only(['index']);
    Route::resource('comments', CommentController::class)->except(['index']);

    // Artist-specific routes
    Route::middleware('CheckRole:artist')->group(function () {
        Route::resource('songs', SongController::class)->except(['index']);
        Route::resource('albums', AlbumController::class)->except(['index']);
        Route::resource('events', EventController::class)->except(['index']);
        Route::resource('categories', CategoryController::class)->except(['show']);
    });

});

require __DIR__.'/auth.php';
