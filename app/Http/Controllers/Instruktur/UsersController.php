<?php

namespace App\Http\Controllers\Instruktur;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $users
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated =  $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'nullable|string|max:50',
            'nim' => 'nullable|numeric'
        ]);

        $user = User::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kelas created successfully',
            'data' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'success' => true,
            'message' => 'Data retrieved successfully',
            'data' => $user
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user,$id)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|string|max:50',
            'nim' => 'nullable|numeric'
        ]);

        $user = User::findOrFail($id); // mencari berdasarkan UUID
        $user->update($validated); // melakukan update

        return response()->json([
            'success' => true,
            'message' => 'User Updated successfully',
            'data' => $user
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id); // Cari user berdasarkan ID
    
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404); // Kirim respons error 404 jika user tidak ditemukan
        }
    
        $user->delete(); // Hapus user jika ditemukan
    
        return response()->json([
            'message' => 'User deleted successfully'
        ], 200); // Kirim respons sukses
    }
    
}
