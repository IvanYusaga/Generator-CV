<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CVController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DataPersonalController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    // Dashboard Route
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    // CV Routes
    Route::get('/cv', [CVController::class, 'index'])->name('cv.preview');

    // Data Personal Routes
    Route::get('/data-personal/edit', [DataPersonalController::class, 'edit'])->name('data-personal.edit');
    Route::put('/data-personal', [DataPersonalController::class, 'update'])->name('data-personal.update');
});
