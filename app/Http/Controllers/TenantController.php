<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    // Web: Return view for browser
    public function index()
    {
        $tenants = Tenant::orderBy('name', 'asc')->get(); // Urutkan berdasarkan nama secara ascending
        return view('tenant.index', compact('tenants'));
    }

    // API: Return JSON for Postman
    public function apiIndex()
    {
        $tenants = Tenant::orderBy('name', 'asc')->get(); // Urutkan untuk konsistensi
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

    // Web: Show form to create new tenant
    public function create()
    {
        return view('tenant.create');
    }

    // Web: Store new tenant
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        Tenant::create($request->all());
        return redirect()->route('tenant.index')->with('success', 'Tenant berhasil ditambahkan!');
    }

    // Web: Show form to edit tenant
    public function edit($id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('tenant.edit', compact('tenant'));
    }

    // Web: Update tenant
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $tenant = Tenant::findOrFail($id);
        $tenant->update($request->all());
        return redirect()->route('tenant.index')->with('success', 'Tenant berhasil diperbarui!');
    }

    // Web: Delete tenant
    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();
        return redirect()->route('tenant.index')->with('success', 'Tenant berhasil dihapus!');
    }
}