<?php

use Illuminate\Http\Request;
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


use App\Http\Controllers\Api\SongController;
use App\Http\Controllers\Api\AlbumController;
Route::get('/songs/trending', [SongController::class, 'getTrendingSongs']);
Route::get('/songs/recommendations', [SongController::class, 'getRecommendations']);
Route::get('/albums', [AlbumController::class, 'index']);