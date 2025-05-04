<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of the tenants.
     */
    public function index()
    {
        $tenants = Tenant::all();
        return view('tenant.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new tenant.
     */
    public function create()
    {
        return view('tenant.create');
    }

    /**
     * Store a newly created tenant in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|max:20',
            'status' => 'required|in:active,inactive',
        ]);

        Tenant::create($validated);

        return redirect()->route('tenant.index')
            ->with('success', 'Tenant berhasil ditambahkan!');
    }

    /**
     * Display the specified tenant.
     */
    public function show(Tenant $tenant)
    {
        return view('tenant.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified tenant.
     */
    public function edit(Tenant $tenant)
    {
        return view('tenant.edit', compact('tenant'));
    }

    /**
     * Update the specified tenant in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'nullable|max:20',
            'status' => 'required|in:active,inactive',
        ]);

        $tenant->update($validated);

        return redirect()->route('tenant.index')
            ->with('success', 'Tenant berhasil diperbarui!');
    }

    /**
     * Remove the specified tenant from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();

        return redirect()->route('tenant.index')
            ->with('success', 'Tenant berhasil dihapus!');
    }
}