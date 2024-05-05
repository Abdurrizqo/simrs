<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (empty($search)) {
            $kecamatan = Kecamatan::all();
        } else {
            $kecamatan = Kecamatan::where('kecamatan', 'like', "%$search%")->get();
        }
        return response()->json(['data' => $kecamatan], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'kecamatan' => 'required|string|max:120|unique:kecamatan,kecamatan',
        ]);

        if ($validate->fails()) {
            return response()->json(['data' => null, 'message' => $validate->errors()->all()], 400);
        }

        try {
            $kecamatan = Kecamatan::create([
                'kecamatan' => $request->kecamatan
            ]);

            return response()->json(['message' => 'Kecamatan created successfully', 'data' => $kecamatan], 201);
        } catch (\Throwable $th) {
            return response()->json(['data' => null, 'message' => $th->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'kecamatan' => 'required|string|max:120|unique:kecamatan,kecamatan,' . $id,
        ]);

        if ($validate->fails()) {
            return response()->json(['data' => null, 'message' => $validate->errors()->all()], 400);
        }

        try {
            $kecamatan = Kecamatan::where('id', $id)->update([
                'kecamatan' => $request->kecamatan
            ]);

            return response()->json(['message' => 'Kecamatan Edited successfully', 'data' => $kecamatan], 201);
        } catch (\Throwable $th) {
            return response()->json(['data' => null, 'message' => $th->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kecamatan = Kecamatan::findOrFail($id);
            $kecamatan->delete();
            return response()->json(['message' => 'Kecamatan deleted successfully', 'data' => null], 200);
        } catch (\Throwable $th) {
            return response()->json(['data' => null, 'message' => $th->getMessage()], 404);
        }
    }
}
