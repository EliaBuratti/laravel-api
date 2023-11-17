<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Middleware\HandleCors;

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

/* 
route api prova funzionante

Route::get('/', function () {

    return response()->json([
    'response' => Project::with('type', 'technology')->paginate(5),
    ]);
}); */
Route::middleware(HandleCors::class)->group(function () {
    Route::get('/project', [ProjectController::class, 'index'])->name('home'); //rotta per restituire file json tramite un controller
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

