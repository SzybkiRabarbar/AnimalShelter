<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShelterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// # Animal #
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/animal', [AnimalController::class, 'list'])->name('animal.list');
    Route::get('/animal/create', [AnimalController::class, 'create'])->name('animal.create');
    Route::get('/animal/{uuid}', [AnimalController::class, 'details'])->name('animal.details');
    Route::put('/animal/{uuid}', [AnimalController::class, 'update'])->name('animal.update');
    Route::get('/animal/edit/{uuid}', [AnimalController::class, 'edit'])->name('animal.edit');
    Route::post('/animal', [AnimalController::class, 'store'])->name('animal.store');
});

// # Shelter #
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/shelter', [ShelterController::class, 'list'])->name('shelter.list');
    Route::get('/shelter/{uuid}', [ShelterController::class, 'details'])->name('shelter.details');
});

// # Profile #
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
