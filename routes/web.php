<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [\App\Http\Controllers\SiteController::class, 'index'])->name('index');

Route::middleware('auth')->group(function () {
    Route::resource('countries', \App\Http\Controllers\CountryController::class);
    Route::resource('genres', \App\Http\Controllers\GenreController::class);
    Route::resource('movies', \App\Http\Controllers\MovieController::class)->except('index', 'show');
    Route::resource('actors', \App\Http\Controllers\ActorController::class)->except('index', 'show');
});

Route::resource('movies', \App\Http\Controllers\MovieController::class)
    ->only('index', 'show');
Route::resource('actors', \App\Http\Controllers\ActorController::class)
    ->only('index', 'show');

Route::get('genres/{genre}/movies', [\App\Http\Controllers\MovieController::class, 'byGenre'])->name('genre.movies');
Route::get('actors/{actor}/movies', [\App\Http\Controllers\MovieController::class, 'byActor'])->name('actor.movies');
