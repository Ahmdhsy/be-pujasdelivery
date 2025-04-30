<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Rute publik
Route::get('/', function () {
    return redirect()->route('login.form');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute yang memerlukan otentikasi admin
Route::middleware(['admin'])->group(function () {
    Route::get('/dashboard', function () {
        // Pengecekan session sudah dipindahkan ke middleware
        return view('dashboard');
    })->name('dashboard');
    
    // Tambahkan rute admin lainnya di sini
});

Route::get('/forgot-password', [LoginController::class, 'forgotPassword'])->name('password.request');
Route::get('/register', [LoginController::class, 'register'])->name('register');
