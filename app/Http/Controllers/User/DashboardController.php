<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\ProfileMahasiswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        $user = $request->user();
        $profile_mahasiswa = ProfileMahasiswa::with(['user'])->where('user_id', $user->id)->first();
        return response()->json([
            'success' => true,
            'profile' => $profile_mahasiswa,

        ]);
    }

    public function chartDashboard(Request $request) {
        $akun1Data = Jurnal::with(['akun'])->where('akun_id', $request->akun_id1 ?? null)->get();
        $akun2Data = Jurnal::with(['akun'])->where('akun_id', $request->akun_id2 ?? null)->get();
        $akun3Data = Jurnal::with(['akun'])->where('akun_id', $request->akun_id3 ?? null)->get();

        $akun1 = [
            'count' => $akun1Data->count(),
            'nama' => $akun1Data->pluck('akun.nama')->unique()[0],
        ];
        $akun2 = [
            'count' => $akun2Data->count(),
            'nama' => $akun2Data->pluck('akun.nama')->unique()[0] ?? null,
        ];
        $akun3 = [
            'count' => $akun3Data->count(),
            'nama' => $akun3Data->pluck('akun.nama')->unique()[0] ?? null,
        ];

        $nama = [
            $akun1['nama'],
            $akun2['nama'],
            $akun3['nama'],
        ];
        $data = [
            $akun1['count'],
            $akun2['count'],
            $akun3['count'],
        ];
        return response()->json([
            'success' =>  true,
            'nama' => $nama,
            'data' => $data,
        ]);

    }
}
