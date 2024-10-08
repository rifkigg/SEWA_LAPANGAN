<?php

use App\Models\Field;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    $fields = Field::all();
    $totalFields = $fields->count();
    return view('welcome', compact('fields', 'totalFields'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); 
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/field', [FieldController::class, 'index'])->name('field.index');
    Route::get('/fieldCreate', [FieldController::class, 'create'])->name('field.create');
    Route::post('/fieldStore', [FieldController::class, 'store'])->name('field.store');
    Route::get('/fieldEdit/{id}', [FieldController::class, 'edit'])->name('field.edit');
    Route::put('/fieldUpdate/{id}', [FieldController::class, 'update'])->name('field.update');
    Route::delete('/fieldDestroy/{id}', [FieldController::class, 'destroy'])->name('field.destroy');

    Route::get('/rental', [RentalController::class, 'index'])->name('rental.index');
    Route::get('/rentalCreate', [RentalController::class, 'create'])->name('rental.create');
    Route::post('/rentalStore', [RentalController::class, 'store'])->name('rental.store');
    Route::get('/rentalEdit/{id}', [RentalController::class, 'edit'])->name('rental.edit');
    Route::put('/rentalUpdate/{id}', [RentalController::class, 'update'])->name('rental.update');
    Route::delete('/rentalDestroy/{id}', [RentalController::class, 'destroy'])->name('rental.destroy');
});

require __DIR__ . '/auth.php';
