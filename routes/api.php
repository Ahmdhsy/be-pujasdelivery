<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

Route::get('/tenants', [TenantController::class, 'apiIndex']);
Route::get('/tenants/{id}', [TenantController::class, 'apiShow']);
Route::get('/menus', [MenuController::class, 'apiIndex']);
Route::get('/menus/{id}', [MenuController::class, 'apiShow']);
Route::post('/transactions', [TransactionController::class, 'store']);
Route::get('/transactions/history', [TransactionController::class, 'history']);
Route::post('/gedung', [GedungController::class, 'store']);
Route::get('/gedung', [GedungController::class, 'index']);
Route::post('/transaction', [TransactionController::class, 'store']);
Route::post('/users/register', [UserController::class, 'register']);
Route::get('/users/me', [UserController::class, 'me']);