<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        // Cek apakah relasi tenant dan category ada
        try {
            $menus = Menu::with('tenant')->get();
            return view('menu', compact('menus'));
        } catch (\Exception $e) {
            // Log error dan tampilkan menu tanpa relasi jika ada masalah
            \Log::error('Error loading menu relations: ' . $e->getMessage());
            $menus = Menu::all();
            return view('menu', compact('menus'));
        }
    }
}