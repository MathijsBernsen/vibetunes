<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SongController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes for regular users
    Route::resource('playlists', PlaylistController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->only(['index', 'show']);
    Route::resource('events', EventController::class)->only(['index', 'show']);
    Route::resource('songs', SongController::class)->only(['index', 'show']);
    Route::resource('albums', AlbumController::class)->only(['index', 'show']);

    // Define routes only for artists with middleware: "CheckRolePermissions"
});

require __DIR__.'/auth.php';
