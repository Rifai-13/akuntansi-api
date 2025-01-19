<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember('akun', 60, function () {
            return Akun::all();
        });
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Akun $akun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Akun $akun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akun $akun)
    {
        //
    }
}
