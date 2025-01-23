<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login_mahasiswa(Request $request) {
        $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(["nim"=>$request->nim, "password"=> $request->password])) {
            $user = Auth::user();
            $data['token'] = $user->createToken('token')->plainTextToken;
            $data['nama'] = $user->nama;
            $data['nim'] = $user->nim;
            $data['email'] = $user->email;
            return response()->json([
                "success" => true,
                "message" => "Login success",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
    }

    public function register_mahasiswa(Request $request) {
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->toArray());

        $data['token'] = $user->createToken('token')->plainTextToken;
        $data['name'] = $user->name;
        $data['nim'] = $user->nim;
        $data['email'] = $user->email;
        return response()->json([
            "success" => true,
            "message" => "Register success",
            "data" => $data
        ], 200);
    }

    public function login_instruktur(Request $request) {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt(["email"=>$request->email, "password"=> $request->password])) {
            $user = Auth::user();
            $data['token'] = $user->createToken('token')->plainTextToken;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['role'] = $user->role;
            return response()->json([
                "success" => true,
                "message" => "Login success",
                "data" => $data
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
    }

    public function register_instruktur(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required',
        ]);

        $request['password'] = Hash::make($request['password']);
        $request['role'] = 'admin';
        $user = User::create($request->toArray());

        $data['token'] = $user->createToken('token')->plainTextToken;
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['role'] = $user->role;
        return response()->json([
            "success" => true,
            "message" => "Register success",
            "data" => $data
        ], 200);
    }

    public function getAllData() {
        $users = User::all(); // Mengambil semua data dari tabel 'users'
    
        return response()->json([
            "success" => true,
            "message" => "Data retrieved successfully",
            "data" => $users
        ], 200);
    }
    
    public function getDataById(Request $request, $id) {
        // Validasi token
        if (!$request->bearerToken()) {
            return response()->json([
                "success" => false,
                "message" => "Token is required"
            ], 401);
        }
    
        // Verifikasi token dan ambil user
        $user = User::find($id); // Ambil data berdasarkan ID
    
        if (!$user) {
            return response()->json([
                "success" => false,
                "message" => "Data not found"
            ], 404);
        }
    
        return response()->json([
            "success" => true,
            "message" => "Data retrieved successfully",
            "data" => $user
        ], 200);
    }
}
