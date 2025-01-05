<?php

use App\Http\Controllers\Films\FilmsController;
use App\Http\Controllers\Genres\GenresController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/genres', GenresController::class)->names('genres');
Route::apiResource('/films', FilmsController::class)->names('films');
Route::get('/films/{id}/publish', [FilmsController::class,'publishFilm'])->name('film.publish');