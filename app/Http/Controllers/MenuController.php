<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    // Web: Return view for browser
    public function index()
    {
        try {
            $menus = Menu::with('tenant')->get();
        } catch (\Exception $e) {
            Log::error('Gagal memuat relasi tenant: ' . $e->getMessage());
            $menus = Menu::all();
        }

        return view('menu', compact('menus'));
    }

    // API: Return JSON for Postman
    public function apiIndex()
    {
        try {
            $menus = Menu::with('tenant')->get();

            $customMenus = $menus->map(function ($menu) {
                return [
                    'id' => $menu->id,
                    'nama' => $menu->nama,
                    'harga' => $menu->harga,
                    'deskripsi' => $menu->deskripsi,
                    'gambar' => $menu->gambar,
                    'category' => $menu->category ? $menu->category->name : null,
                    'tenant' => $menu->tenant ? $menu->tenant->name : null,
                    'created_at' => $menu->created_at,
                    'updated_at' => $menu->updated_at,
                ];
            });

            return response()->json($customMenus, 200);

        } catch (\Exception $e) {
            Log::error('Gagal memuat relasi tenant: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load menus'], 500);
        }
    }

    // API: Get specific menu
    public function apiShow($id)
    {
        try {
            $menu = Menu::with('tenant')->find($id);
            if (!$menu) {
                return response()->json(['message' => 'Menu not found'], 404);
            }

            $customMenu = [
                'id' => $menu->id,
                'nama' => $menu->nama,
                'harga' => $menu->harga,
                'deskripsi' => $menu->deskripsi,
                'gambar' => $menu->gambar,
                'tenant' => $menu->tenant ? $menu->tenant->name : null,
                'category' => $menu->category ? $menu->category->name : null,
                'created_at' => $menu->created_at,
                'updated_at' => $menu->updated_at,
            ];

            return response()->json($customMenu, 200);

        } catch (\Exception $e) {
            Log::error('Gagal memuat menu: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load menu'], 500);
        }
    }
}
