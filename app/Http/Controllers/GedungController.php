<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gedung;

class GedungController extends Controller
{
    public function index()
    {
        return response()->json(Gedung::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_gedung' => 'required|string|max:255',
        ]);

        $gedung = Gedung::create($validated);

        return response()->json([
            'message' => 'Gedung berhasil ditambahkan.',
            'data' => $gedung
        ], 201);
    }
}
