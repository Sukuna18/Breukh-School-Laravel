<?php

use App\Http\Controllers\AuthController;
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
Route::get('/classes/{classes}', [App\Http\Controllers\ClassesController::class, 'show']);
Route::get('/niveaux', [App\Http\Controllers\NiveauxController::class, 'index']);
Route::get('/niveaux/{id}', [App\Http\Controllers\NiveauxController::class, 'find']);
Route::apiResource('eleves', App\Http\Controllers\EleveController::class)->parameter('eleves', 'eleve')->only(['index', 'store', 'destroy']);
Route::get('/eleves/{eleve}', [App\Http\Controllers\EleveController::class, 'show']);
Route::get('/disciplines', [App\Http\Controllers\DisciplineController::class, 'index']);
Route::post('/disciplines', [App\Http\Controllers\DisciplineController::class, 'store']);
Route::get('/classes/coef', [App\Http\Controllers\ClasseDisciplineController::class, 'index']);
Route::post('/classes/coef', [App\Http\Controllers\ClasseDisciplineController::class, 'store']);
Route::get('/coefs', [App\Http\Controllers\EvaluationController::class, 'index']);
Route::post('/coefs', [App\Http\Controllers\EvaluationController::class, 'store']);
Route::get('/inscription', [App\Http\Controllers\InscriptionsController::class, 'index']);
Route::put('/eleve/sortie', [App\Http\Controllers\EleveController::class, 'sortie']);
Route::get('classes/{classes}/discipline/{disciplines}/evaluations/{evaluations}', [App\Http\Controllers\ClassesController::class, 'getNotes']);
Route::post('classes/{classes}/discipline/{disciplines}/evaluations/{evaluations}', [App\Http\Controllers\ClassesController::class, 'addNote']);
Route::put('classes/{classes}/discipline/{disciplines}/evaluations/{evaluations}', [App\Http\Controllers\ClassesController::class, 'editNotes']);
Route::get('classes/{classes}/discipline/{disciplines}/evaluations/{evaluations}/eleve/{eleve}', [App\Http\Controllers\ClassesController::class, 'getNotesByEleve']);
Route::get('classes/{classes}/discipline/{disciplines}/notes', [App\Http\Controllers\ClassesController::class, 'getNotesByDiscipline']);
Route::get('classes/{classes}/notes', [App\Http\Controllers\ClassesController::class, 'getNotesByClasse']);
Route::get('classes/{classes}/notes/eleve/{eleve}', [App\Http\Controllers\ClassesController::class, 'getAllNotesEleveByClasse']);
Route::post('/evenements', [App\Http\Controllers\EventsController::class, 'store']);
Route::get('/evenements', [App\Http\Controllers\EventsController::class, 'index']);
Route::post('/evenements/{evenement}/participations', [App\Http\Controllers\EventsController::class, 'addParticipation']);
Route::get('/evenements/{evenement}/participations', [App\Http\Controllers\EventsController::class, 'getParticipations']);
Route::post('login', [AuthController::class, 'login']);
Route::post('users', [App\Http\Controllers\UserController::class, 'store']);
Route::get('users', [App\Http\Controllers\UserController::class, 'index']);
Route::get('users/{user}', [App\Http\Controllers\UserController::class, 'show']);
Route::put('users/{user}', [App\Http\Controllers\UserController::class, 'update']);
Route::delete('users/{user}', [App\Http\Controllers\UserController::class, 'destroy']);

Route::middleware('auth:api')->group(function () {

  Route::get('user', function (Request $request) {
    return $request->user();
  });

  Route::post('users/{id}/logout', function (Request $request, $id) {
    $user = App\Models\User::find($id);
    $user->tokens()->delete();
    // $request->user()->token()->revoke();
    return response()->json(['message' => 'Logged out'], 200);
  });

});
