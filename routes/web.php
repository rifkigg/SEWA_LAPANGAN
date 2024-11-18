<?php

use App\Models\User;
use App\Models\Field;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserRole;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ProfileController;

Route::get('/unauthorized', function () {
    return view('unauthorized');
});

Route::get('/', function () {
    $fields = Field::all();
    $totalFields = $fields->count();
    return view('welcome', compact('fields', 'totalFields'));
})->name('home');

Route::middleware('auth')->group(function () {

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/field/show/{id}', [FieldController::class, 'show'])->name('field.show');
    
    Route::get('/rentalCreate/{id}', [RentalController::class, 'create'])->name('rental.create');
    Route::post('/rentalStore', [RentalController::class, 'store'])->name('rental.store');
    Route::get('/rental/process/{id}', [RentalController::class, 'process'])->name('rental.process');
    
    Route::group(['middleware' => [CheckUserRole::class]], function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        
        Route::group(['prefix' => 'field'], function () {
            Route::get('/', [FieldController::class, 'index'])->name('field.index');
            Route::get('/create', [FieldController::class, 'create'])->name('field.create');
            Route::post('/store', [FieldController::class, 'store'])->name('field.store');
            Route::get('/edit/{id}', [FieldController::class, 'edit'])->name('field.edit');
            Route::put('/update/{id}', [FieldController::class, 'update'])->name('field.update');
            Route::delete('/destroy/{id}', [FieldController::class, 'destroy'])->name('field.destroy');
        });

        Route::group(['prefix' => 'rental'], function () {
            Route::get('/', [RentalController::class, 'index'])->name('rental.index');
            Route::get('/edit/{id}', [RentalController::class, 'edit'])->name('rental.edit');
            Route::put('/update/{id}', [RentalController::class, 'update'])->name('rental.update');
            Route::delete('/destroy/{id}', [RentalController::class, 'destroy'])->name('rental.destroy');
            Route::put('/updatePaymentStatus/{id}', [RentalController::class, 'updatePaymentStatus'])->name('rental.updatePaymentStatus');
            Route::put('/updateStatus/{id}', [RentalController::class, 'updateStatus'])->name('rental.updateStatus');
        });
    });
});
Route::get('/auth/{provider}', function ($provider) {
    return Socialite::driver($provider)->redirect();
})->name('login.provider');

Route::get('/auth/{provider}/callback', function ($provider) {
    $socialUser = Socialite::driver($provider)->user();

    // Cek apakah user sudah ada di database
    $user = User::firstOrCreate([
        'email' => $socialUser->getEmail(),
    ], [
        'username' => $socialUser->getName(),
        'provider_id' => $socialUser->getId(),
        'provider' => $provider,
        'avatar' => $socialUser->getAvatar(), // Simpan avatar
        'password' => Hash::make(uniqid()), // Password random
    ]);

    // Login user
    Auth::login($user);

    return redirect('/');
});

require __DIR__ . '/auth.php';
