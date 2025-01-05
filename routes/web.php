<?php

use App\Http\Controllers\Genres\GenresController;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $genres = Genre::all();
    $film = Film::find(2);
    return view('welcome', compact('genres','film'));
});