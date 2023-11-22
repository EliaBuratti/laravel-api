<?php

use App\Http\Controllers\Api\LeadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TechnologyController;
use App\Http\Controllers\Api\TypeController;
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
    Route::get('project', [ProjectController::class, 'index'])->name('home'); //rotta per restituire file json tramite un controller
    Route::get('project/{project:slug}', [ProjectController::class, 'show']);
    Route::get('technology', [TechnologyController::class, 'index']);
    Route::get('technology/{technology:slug}', [TechnologyController::class, 'show']);
    Route::get('type', [TypeController::class, 'index']);
    Route::get('type/{type:slug}', [TypeController::class, 'show']);
    Route::post('contacts', [LeadController::class, 'store']);


});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

