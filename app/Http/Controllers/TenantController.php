<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    // Web: Return view for browser
    public function index()
    {
        $tenants = Tenant::all();
        return view('tenant.index', compact('tenants'));
    }

    // API: Return JSON for Postman
    public function apiIndex()
    {
        $tenants = Tenant::all();
        return response()->json($tenants, 200);
    }

    // API: Get specific tenant
    public function apiShow($id)
    {
        $tenant = Tenant::find($id);
        if (!$tenant) {
            return response()->json(['message' => 'Tenant not found'], 404);
        }
        return response()->json($tenant, 200);
    }
}