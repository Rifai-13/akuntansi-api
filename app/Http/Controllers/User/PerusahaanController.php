<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Krs;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Perusahaan::with(['kategori', 'krs.mahasiswa', 'krs.kelas'])->get();
        return response()->json([
            'success' => true,
            'data' => $data,
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'tahun_berdiri' => 'required|integer',
            'status' => 'required|string|in:active,inactive',
            'kategori_id' => 'required',
            'krs_id' => 'required',
        ]);
        Perusahaan::create($request);
        return response()->json([
            'success' => true,
            'message' => "Data successfully saved",
        ], 201);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Perusahaan::with(['kategori', 'krs.mahasiswa', 'krs.kelas'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => true,
                'message' => "Data Not Found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $perusahaan = Perusahaan::with(['kategori', 'krs.mahasiswa', 'krs.kelas'])->findOrFail($id);
            $request = $request->validate([
                'nama' => 'sometimes|string',
                'alamat' => 'sometimes|string',
                'tahun_berdiri' => 'sometimes|integer',
                'status' => 'sometimes|string|in:active,inactive',
                'kategori_id' => 'sometimes',
                'krs_id' => 'sometimes',
            ]);
            $perusahaan->update($request);
            return response()->json([
                'success' => true,
                'message' => 'Data Successfully Changed',
                'data' => $perusahaan,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => true,
                'message' => "Data Failed Changed",
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $perusahaan = Perusahaan::findOrFail($id)->delete();
            return response()->json([
                'success' => true,
                'message' => "Data Successfully Deleted"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => true,
                'message' => "Data Failed Deleted"
            ], 404);
        }
    }

    public function status(Request $request) {
        $data = Perusahaan::where('krs_id', $request->krs_id)->where('id', $request->perusahaan_id)->first();
        $data->update(['status' => ($data->status == 'online') ? 'offline' : 'online']);
        return response()->json(
            [
                'data' => $data,
            ]
        );
    }
}
