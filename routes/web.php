<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SongController;

Route::resource('albums', AlbumController::class);
Route::resource('songs', SongController::class);
