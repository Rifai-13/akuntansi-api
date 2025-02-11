<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Jurnal;
use App\Models\SubAkun;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class JurnalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Jurnal::with(['akun', 'subAkun', 'perusahaan',])->get()->sortByDesc('tanggal')->groupBy('keterangan');
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
        if ($request['sub_akun_id'] != null) {
            $request = $request->validate([
                'tanggal' => "required",
                'bukti' => 'sometimes|nullable',
                'keterangan' => "sometimes|nullable",
                'akun_id' => "sometimes|nullable",
                'debit' => "sometimes|nullable",
                'kredit' => "sometimes|nullable",
                'perusahaan_id' => "required",
                'sub_akun_id' => "sometimes|nullable",
            ]);
            $request['akun_id'] = SubAkun::where('id', $request['sub_akun_id'])->first()->akun_id;
        } else {
            $request = $request->validate([
                'tanggal' => "required",
                'bukti' => 'sometimes|nullable',
                'keterangan' => "sometimes|nullable",
                'akun_id' => "required",
                'debit' => "sometimes|nullable",
                'kredit' => "sometimes|nullable",
                'perusahaan_id' => "required",
                'sub_akun_id' => "sometimes|nullable",
            ]);
        }
        Jurnal::create($request);
        return response()->json([
            'success' => true,
            'message' => "Data successfully saved",
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $jurnal)
    {
        try {
            $data = Jurnal::with(['akun', 'subAkun', 'perusahaan'])->findOrFail($jurnal);
            return response()->json([
                'success' => true,
                'data' => $data,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => "Data Not Found",
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $jurnal)
    {
        try {
            $jurnal = Jurnal::with(['akun', 'subAkun', 'perusahaan'])->findOrFail($jurnal);
            $request = $request->validate([
                'tanggal' => "sometimes|date",
                'bukti' => 'sometimes|nullable|string',
                'keterangan' => "sometimes|nullable|string",
                'akun_id' => "sometimes|uuid",
                'debit' => "sometimes|nullable",
                'kredit' => "sometimes|nullable",
                'perusahaan_id' => "sometimes|uuid",
                'sub_akun_id' => "sometimes|nullable|uuid",
            ]);
            $jurnal->update($request);
            return response()->json([
                'success' => true,
                'message' => 'Data successfully changed',
                'data' => $jurnal
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Data failed changed',
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($jurnal)
    {
        try {
            $jurnal = Jurnal::findOrFail($jurnal)->delete();
            return response()->json([
                'success' =>  true,
                'message' => "Data successfully deleted"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' =>  true,
                'message' => "Data failed deleted"
            ], 404);
        }
    }
}
