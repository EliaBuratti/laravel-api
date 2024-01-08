<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\admin\TypeController;
use App\Http\Controllers\admin\TechnologyController;
use App\Http\Controllers\Api\LeadController;
use Illuminate\Support\Facades\Route;
use App\Models\Project;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $projects =  Project::all();
    return view('guests.welcome', compact('projects'));
});

Route::get('/dashboard', function () {
    $projects =  Project::all();
    return to_route('admin.dashboard', compact('projects'));
});

/* Route::get('/dashboard', function () {
    $projects =  Project::all();
    return view('admin.dashboard', compact('projects'));
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // All routes will start with '/admin/...'
    //route('admin.dashboard')

    Route::resource('dashboard/project', ProjectController::class)->parameters([
        'project' => 'project:slug'
    ]);
    Route::resource('dashboard/type', TypeController::class)->parameters([
        'type' => 'type:slug'
    ]);
    Route::resource('dashboard/technology', TechnologyController::class)->parameters([
        'technology' => 'technology:slug'
    ]);
    Route::get('dashboard/mail/sent', [MailController::class, 'index'])->name('mail.sent');
    Route::post('dashboard/mail/sent', [MailController::class, 'store'])->name('mail.store.response');
    Route::delete('dashboard/mail/sent/{id}', [MailController::class, 'destroy'])->name('mail.sent.destroy');

    Route::get('dashboard/mail/leads', [LeadController::class, 'index'])->name('mail.leads');
    Route::delete('dashboard/mail/leads/{id}', [MailController::class, 'destroy'])->name('mail.lead.destroy');
    
/*     Route::resource('dashboard/mail', MailController::class)->parameters([
        'mail' => 'mail:id'
    ]); */
    Route::get('dashboard/mail/lead/assistant/{id}', [MailController::class, 'assistantResponse'])->name('ai.assistant');

    //Route::post('dashboard/response', [MailController::class, 'store'])->name('response');

});



require __DIR__ . '/auth.php';
