<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (empty($search)) {
            $kabupaten = Kabupaten::all();
        } else {
            $kabupaten = Kabupaten::where('kabupaten', 'like', "%$search%")->get();
        }
        return response()->json(['data' => $kabupaten], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'kabupaten' => 'required|string|max:120|unique:kabupaten,kabupaten',
        ]);

        if ($validate->fails()) {
            return response()->json(['data' => null, 'message' => $validate->errors()->all()], 400);
        }

        try {
            $kabupaten = Kabupaten::create([
                'kabupaten' => $request->kabupaten
            ]);

            return response()->json(['message' => 'Kabupaten created successfully', 'data' => $kabupaten], 201);
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
            'kabupaten' => 'required|string|max:120|unique:kabupaten,kabupaten,' . $id,
        ]);

        if ($validate->fails()) {
            return response()->json(['data' => null, 'message' => $validate->errors()->all()], 400);
        }

        try {
            $kabupaten = Kabupaten::where('id', $id)->update([
                'kabupaten' => $request->kabupaten
            ]);

            return response()->json(['message' => 'Kabupaten Edited successfully', 'data' => $kabupaten], 201);
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
            $kabupaten = Kabupaten::findOrFail($id);
            $kabupaten->delete();
            return response()->json(['message' => 'Kabupaten deleted successfully', 'data' => null], 200);
        } catch (\Throwable $th) {
            return response()->json(['data' => null, 'message' => $th->getMessage()], 404);
        }
    }
}
