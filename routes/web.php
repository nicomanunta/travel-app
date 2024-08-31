<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TripController;
use App\Http\Controllers\Admin\DayController;
use App\Http\Controllers\Admin\StopController;
use App\Http\Controllers\Admin\NoteController;
use App\Http\Controllers\Admin\RatingController;


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
    return view('welcome');
});


Route::get('/dashboard', [TripController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/admin/trips/{id}', [TripController::class, 'show']);


Route::middleware(['auth', 'verified'])->name('admin.')->group(function () {
    Route::resource('trips', TripController::class);
    Route::resource('days', DayController::class);
    Route::resource('stops', StopController::class);
    Route::resource('notes', NoteController::class);
    Route::resource('ratings', RatingController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
