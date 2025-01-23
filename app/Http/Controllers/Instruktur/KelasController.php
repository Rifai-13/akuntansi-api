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
            \Illuminate\Support\Facades\Log::error($e->getMessage());
    
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
    public function show(Kelas $kelas)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $kelas
        ]);
    }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, $id)
{
    try {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'angkatan' => 'required|integer',
        ]);

        // Validasi UUID
        $kelas = Kelas::findOrFail($id); // mencari berdasarkan UUID
        $kelas->update($validated); // melakukan update

        \Illuminate\Support\Facades\Log::info('Update attempt for Kelas ID: ' . $kelas->id);
        \Illuminate\Support\Facades\Log::info('Updated data: ', $validated);

        return response()->json([
            'success' => true,
            'message' => 'Kelas updated successfully',
            'data' => $kelas
        ]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Jika data tidak ditemukan
        \Illuminate\Support\Facades\Log::error('Kelas with ID ' . $id . ' not found');
        return response()->json([
            'success' => false,
            'message' => 'Kelas not found'
        ], 404);
    } catch (\Exception $e) {
        // Tangani error lainnya
        \Illuminate\Support\Facades\Log::error('Error updating kelas: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error updating kelas: ' . $e->getMessage()
        ], 500);
    }
}


    public function destroy($id)
    {
        try {
            $kelas = Kelas::findOrFail($id);
    
            \Illuminate\Support\Facades\Log::info('Delete attempt for Kelas ID: ' . $kelas->id);
    
            $kelas->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Kelas deleted successfully'
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error deleting kelas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting kelas: ' . $e->getMessage()
            ], 500);
        }
    }
    
}