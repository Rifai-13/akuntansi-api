<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\ProfileInstruktur;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileInstrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan semua data profile_instruktur beserta relasi user dan kelas
        $profiles = ProfileInstruktur::with(['user', 'kelas'])->get(); // Menggunakan eager loading
        
        return response()->json([
            'success' => true,
            'data' => $profiles
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|uuid|exists:users,id',
            'kelas_id' => 'required|uuid|exists:kelas,id',
        ]);

        // Menambahkan ID UUID secara otomatis
        $validated['id'] = Str::uuid();

        // Menyimpan data baru
        $profile = ProfileInstruktur::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Profile Instruktur created successfully',
            'data' => $profile
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfileInstruktur $profileInstruktur)
    {
        // Menampilkan data berdasarkan ID
        return response()->json([
            'success' => true,
            'data' => $profileInstruktur
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfileInstruktur $profileInstruktur,$id)
    {
        // Validasi input
        $validated = $request->validate([
            'user_id' => 'required|uuid|exists:users,id',
            'kelas_id' => 'required|uuid|exists:kelas,id',
        ]);

        // Melakukan update data
        $profileInstruktur = ProfileInstruktur::findOrFail($id);
        $profileInstruktur->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Profile Instruktur updated successfully',
            'data' => $profileInstruktur
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Menghapus data
        $profileInstruktur = ProfileInstruktur::findOrFail($id);
        $profileInstruktur->delete();

        return response()->json([
            'success' => true,
            'message' => 'Profile Instruktur deleted successfully'
        ]);
    }
}
