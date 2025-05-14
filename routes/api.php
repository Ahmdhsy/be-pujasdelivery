<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TenantController;

Route::get('/tenants', [TenantController::class, 'apiIndex']);
Route::get('/tenants/{id}', [TenantController::class, 'apiShow']);
Route::get('/menus', [MenuController::class, 'apiIndex']);
Route::get('/menus/{id}', [MenuController::class, 'apiShow']);