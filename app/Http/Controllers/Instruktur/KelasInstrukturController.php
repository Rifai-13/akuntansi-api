<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\ProfileInstruktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasInstrukturController extends Controller
{
    public function __construct()
    {
        $user = Auth::user();
        if ($user->role != 1) {
            return response()->json([
                'message' => 'Anda Tidak Bisa Mengakses Halaman Ini'
            ], 403);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profileInstruktur = ProfileInstruktur::with(['user', 'kelas'])->get();
        return response()->json([
            'success' => true,
            'data' => $profileInstruktur,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|uuid',
            'kelas_id' => 'required|uuid',
        ]);

        ProfileInstruktur::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $find = ProfileInstruktur::with(['user', 'kelas'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $find
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => true,
                'message' => 'Data Not Found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $find = ProfileInstruktur::with(['user','kelas'])->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => true,
                'message' => "Data failed changed",
            ], 200);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|uuid',
            'kelas_id' => 'sometimes|uuid',
        ]);

        $find->update($validated);
        return response()->json([
            'success' => true,
            'message' => "Data successfully changed",
            'data' => $find,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            ProfileInstruktur::findOrFail($id)->delete();
            return response()->json([
                'success'=>true,
                'message'=>'Data successfully deleted',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success'=>true,
                'message'=>'Data failed deleted',
            ]);
        }
    }
}
