<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tenant;

class TenantApiController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all();
        return response()->json([
            'status' => true,
            'message' => 'Data tenant berhasil diambil',
            'data' => $tenants
        ]);
    }
}

