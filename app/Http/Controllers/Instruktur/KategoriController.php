<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all(); // Mengambil semua data kategori
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);
    
        // Membuat data kategori baru tanpa menyebutkan ID
        $kategori = Kategori::create([
            'nama' => $validated['nama'],
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Kategori created successfully',
            'data' => $kategori
        ], 201);
    }    

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Update data kategori
        $kategori->update([
            'nama' => $validated['nama'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kategori updated successfully',
            'data' => $kategori
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori deleted successfully'
        ]);
    }
}
