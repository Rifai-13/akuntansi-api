<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Cache::remember('kategori', 60, function () {
            return Kategori::all();
        });
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'kategori' => 'required'
        ]);
        Kategori::create($request->all());

        $keyCache = 'kategori';
        $data = Cache::add($keyCache, Kategori::all(), 60);
        // $data = Cache::remember($keyCache, now()->addMinute(1), function () {
        //     return Kategori::all();
        // });
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
