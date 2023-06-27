<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/classes', [App\Http\Controllers\ClassesController::class, 'index']);
Route::get('/niveaux', [App\Http\Controllers\NiveauxController::class, 'index']);
Route::get('/niveaux/{id}', [App\Http\Controllers\NiveauxController::class, 'find']);