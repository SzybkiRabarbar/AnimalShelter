<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\VolunteeringController;

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

// # Adoption #
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/adoption', [AdoptionController::class, 'list'])->name('adoption.list');
    Route::post('/adoption', [AdoptionController::class, 'create'])->name('adoption.create');
    Route::get('/adoption/{uuid}', [AdoptionController::class, 'details'])->name('adoption.details');
    Route::patch('/adoption/{uuid}/accept', [AdoptionController::class, 'accept'])->name('adoption.accept');
    Route::patch('/adoption/{uuid}/unaccept', [AdoptionController::class, 'unaccept'])->name('adoption.unaccept');
    Route::patch('/adoption/{uuid}/taken', [AdoptionController::class, 'taken'])->name('adoption.taken');
});

// # Volunteering #
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/volunteering', [VolunteeringController::class, 'list'])->name('volunteering.list');
    Route::post('/volunteering', [VolunteeringController::class, 'create'])->name('volunteering.create');
    Route::get('/volunteering/{uuid}', [VolunteeringController::class, 'details'])->name('volunteering.details');
    Route::patch('/volunteering/{uuid}/accept', [VolunteeringController::class, 'accept'])->name('volunteering.accept');
    Route::patch('/volunteering/{uuid}/unaccept', [VolunteeringController::class, 'unaccept'])->name('volunteering.unaccept');
    Route::patch('/volunteering/{uuid}/taken', [VolunteeringController::class, 'tookPlace'])->name('volunteering.taken');
});

// # Profile #
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
