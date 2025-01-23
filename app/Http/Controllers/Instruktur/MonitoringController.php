<?php

namespace App\Http\Controllers\Instruktur;

use App\Models\Krs;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Models\ProfileInstruktur;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mendapatkan instruktur yang sedang login
        $user = Auth::user();
    
        // Mendapatkan kelas berdasarkan instruktur yang sedang login
        $kelas = Kelas::whereHas('profileInstruktur', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
    
        return response()->json([
            'success' => true,
            'data' => $kelas
        ]);
    }
    

    /**
     * Menampilkan anggota kelas berdasarkan kelas yang dipilih.
     */
    public function showKelasAnggota($kelas_id)
    {
        // Mendapatkan anggota kelas berdasarkan kelas_id
        $kelas = Kelas::findOrFail($kelas_id);

        // Ambil data anggota kelas dari tabel KRS
        $anggota = Krs::where('kelas_id', $kelas_id)
            ->with('mahasiswa') // Menampilkan data mahasiswa
            ->get();

        return response()->json([
            'success' => true,
            'data' => $anggota
        ]);
    }

        /**
     * Menampilkan kelas berdasarkan ID ProfileInstruktur.
     */
    public function getKelasByProfileInstrukturId($profile_instruktur_id)
    {
        // Cari ProfileInstruktur berdasarkan ID
        $profileInstruktur = ProfileInstruktur::with('kelas')->findOrFail($profile_instruktur_id);

        // Ambil data user_id dan kelas_id
        return response()->json([
            'success' => true,
            'data' => [
                'user_id' => $profileInstruktur->user_id,
                'kelas_id' => $profileInstruktur->kelas_id,
                'kelas' => $profileInstruktur->kelas, // Menampilkan detail kelas yang terkait
            ]
        ]);
    }

    /**
     * Menampilkan anggota kelas berdasarkan ID ProfileInstruktur.
     */
    public function getAnggotaByProfileInstruktur($profile_instruktur_id)
    {
        // Cari ProfileInstruktur berdasarkan ID
        $profileInstruktur = ProfileInstruktur::findOrFail($profile_instruktur_id);

        // Ambil kelas yang terkait dengan ProfileInstruktur
        $kelas = $profileInstruktur->kelas;

        if (!$kelas) {
            return response()->json([
                'success' => false,
                'message' => 'Kelas tidak ditemukan untuk ProfileInstruktur ini.'
            ], 404);
        }

        // Ambil data anggota kelas dari tabel KRS
        $anggota = Krs::where('kelas_id', $kelas->id)
            ->with('mahasiswa') // Relasi ke mahasiswa
            ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'user_id' => $profileInstruktur->user_id,  // Menampilkan user_id
                    'kelas_id' => $profileInstruktur->kelas_id,  // Menampilkan kelas_id
                    'kelas' => [
                        'id' => $profileInstruktur->kelas->id,  // ID kelas
                        'nama' => $profileInstruktur->kelas->nama,  // Nama kelas
                        'angkatan' => $profileInstruktur->kelas->angkatan,  // Angkatan kelas
                    ],
                    'anggota' => $anggota,
                ]
            ]);
    }
}
