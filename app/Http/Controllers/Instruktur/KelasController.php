<?php

namespace App\Http\Controllers\Instruktur;

use Log;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $kelas = Kelas::all()->fresh();

            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $kelas,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving data',
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'angkatan' => 'required|integer',
        ]);

        $kelas = Kelas::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kelas created successfully',
            'data' => $kelas
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kela)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $kela
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kela)
    {
        $request = $request->validate([
            'nama' => 'sometimes|string',
            'angkatan' => 'sometimes|integer',
        ]);

        $kela->update($request);

        return response()->json([
            'success' => true,
            'message' => 'Data Update Successfully',
            'data' => $kela
        ]);
    }


    public function destroy($kela)
    {
        try {
            $kelas = Kelas::findOrFail($kela);
            $kelas->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kelas deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Kelas deleted faileds'
            ], 404);
        }
    }

}
