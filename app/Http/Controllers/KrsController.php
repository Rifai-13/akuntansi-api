<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data KRS dengan relasi kelas dan mahasiswa
        $krs = Krs::with(['kelas', 'mahasiswa'])->get();

        return response()->json([
            'success' => true,
            'data' => $krs
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        // Membuat data KRS baru
        $krs = Krs::create($request->only('user_id', 'kelas_id'));

        return response()->json([
            'success' => true,
            'message' => 'KRS berhasil ditambahkan',
            'data' => $krs
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Menampilkan detail data KRS berdasarkan ID
        $krs = Krs::with(['kelas', 'mahasiswa'])->find($id);

        if (!$krs) {
            return response()->json([
                'success' => false,
                'message' => 'KRS tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $krs
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        // Cari data KRS
        $krs = Krs::find($id);

        if (!$krs) {
            return response()->json([
                'success' => false,
                'message' => 'KRS tidak ditemukan'
            ], 404);
        }

        // Update data KRS
        $krs->update($request->only('user_id', 'kelas_id'));

        return response()->json([
            'success' => true,
            'message' => 'KRS berhasil diperbarui',
            'data' => $krs
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data KRS
        $krs = Krs::find($id);

        if (!$krs) {
            return response()->json([
                'success' => false,
                'message' => 'KRS tidak ditemukan'
            ], 404);
        }

        // Hapus data KRS
        $krs->delete();

        return response()->json([
            'success' => true,
            'message' => 'KRS berhasil dihapus'
        ]);
    }
}
