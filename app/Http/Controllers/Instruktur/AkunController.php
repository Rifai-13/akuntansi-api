<?php

namespace App\Http\Controllers\Instruktur;

use App\Models\Akun;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data akun
        $akun = Akun::with('kategori')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $akun,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kode' => 'required|integer|unique:akun,kode',
            'nama' => 'required|string|max:255',
            'status' => 'nullable|string|in:open,close',
            'kategori_id' => 'required|uuid|exists:kategori,id',
        ]);

        // Membuat data akun baru
        $akun = Akun::create([
            'id' => (string) Str::uuid(),
            'kode' => $validated['kode'],
            'nama' => $validated['nama'],
            'status' => $validated['status'] ?? 'close',
            'kategori_id' => $validated['kategori_id'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Akun created successfully',
            'data' => $akun,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Akun $akun)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $akun->load('kategori'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Akun $akun)
    {
        // Validasi input
        $validated = $request->validate([
            'kode' => 'sometimes|integer|unique:akun,kode,' . $akun->id,
            'nama' => 'sometimes|string|max:255',
            'status' => 'sometimes|string|in:open,close',
            'kategori_id' => 'sometimes|uuid|exists:kategori,id',
        ]);
    
        // Update data akun
        $updated = $akun->update($validated);
    
        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update Akun',
            ]);
        }
    
        return response()->json([
            'success' => true,
            'message' => 'Akun updated successfully',
            'data' => $akun->fresh()->load('kategori'),
        ]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akun $akun)
    {
        $akun->delete();

        return response()->json([
            'success' => true,
            'message' => 'Akun deleted successfully',
        ]);
    }
}
