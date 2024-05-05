<?php

namespace App\Http\Controllers;

use App\Models\CacatFisik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CacatFisikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (empty($search)) {
            $cacatFisik = CacatFisik::all();
        } else {
            $cacatFisik = CacatFisik::where('cacat_fisik', 'like', "%$search%")->get();
        }
        return response()->json(['data' => $cacatFisik], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'cacat_fisik' => 'required|string|max:120|unique:cacat_fisik,cacat_fisik',
        ]);

        if ($validate->fails()) {
            return response()->json(['data' => null, 'message' => $validate->errors()->all()], 400);
        }

        try {
            $cacatFisik = CacatFisik::create([
                'cacat_fisik' => $request->cacat_fisik
            ]);

            return response()->json(['message' => 'Cacat Fisik created successfully', 'data' => $cacatFisik], 201);
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
            'cacat_fisik' => 'required|string|max:120|unique:cacat_fisik,cacat_fisik,' . $id,
        ]);

        if ($validate->fails()) {
            return response()->json(['data' => null, 'message' => $validate->errors()->all()], 400);
        }

        try {
            $cacatFisik = CacatFisik::where('id', $id)->update([
                'cacat_fisik' => $request->cacat_fisik
            ]);

            return response()->json(['message' => 'Cacat Fisik Edited successfully', 'data' => $cacatFisik], 201);
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
            $cacatFisik = CacatFisik::findOrFail($id);
            $cacatFisik->delete();
            return response()->json(['message' => 'Cacat Fisik deleted successfully', 'data' => null], 200);
        } catch (\Throwable $th) {
            return response()->json(['data' => null, 'message' => $th->getMessage()], 404);
        }
    }
}
