<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\MenuApiController;
use App\Http\Controllers\Api\TenantApiController;

Route::get('/menus', [MenuApiController::class, 'index']);
Route::get('/tenants', [TenantApiController::class, 'index']);
