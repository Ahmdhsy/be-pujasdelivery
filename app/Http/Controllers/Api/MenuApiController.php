<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class MenuApiController extends Controller
{
    public function index()
    {
        $menus = Menu::with('tenant')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data menu berhasil diambil',
            'data' => $menus
        ]);
    }
}

