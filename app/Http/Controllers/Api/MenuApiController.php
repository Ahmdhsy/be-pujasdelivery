<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuApiController extends Controller
{
    public function index()
    {
        $menus = Menu::with('tenant')->get();

        // Ubah data agar tenant hanya menampilkan nama
        $data = $menus->map(function ($menu) {
            return [
                'id' => $menu->id,
                'nama' => $menu->nama,
                'harga' => $menu->harga,
                'deskripsi' => $menu->deskripsi,
                'gambar' => $menu->gambar,
                'tenant' => $menu->tenant->name ?? null, // tampilkan hanya nama tenant
                'category' => $menu->category,
                'created_at' => $menu->created_at,
                'updated_at' => $menu->updated_at,
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'Data menu berhasil diambil',
            'data' => $data
        ]);
    }
}


