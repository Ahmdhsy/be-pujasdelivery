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
Route::get('/transactions/{id}', [TransactionController::class, 'show']);
Route::get('/transactions/history', [TransactionController::class, 'getTransactions']); 
Route::post('/gedung', [GedungController::class, 'store']);
Route::get('/gedung', [GedungController::class, 'index']);
Route::post('/users/register', [UserController::class, 'register']);
Route::get('/users/me', [UserController::class, 'me']);
Route::get('/transactions/courier/ongoing', [TransactionController::class, 'getCourierOngoingTransactions']);
Route::get('/transactions/courier/history', [TransactionController::class, 'getCourierHistoryTransactions']);
Route::put('/transactions/{id}/status', [TransactionController::class, 'updateStatus']);

