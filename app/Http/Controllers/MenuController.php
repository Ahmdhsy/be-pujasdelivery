<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function index()
    {
        try {
            $menus = Menu::with('tenant')->get(); // Eager loading relasi tenant
        } catch (\Exception $e) {
            Log::error('Gagal memuat relasi tenant: ' . $e->getMessage());
            $menus = Menu::all();
        }

        return view('menu', compact('menus')); // arahkan ke resources/views/menu.blade.php
    }
}
