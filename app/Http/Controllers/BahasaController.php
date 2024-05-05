<?php

namespace App\Http\Controllers;

use App\Models\Bahasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BahasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (empty($search)) {
            $menus = Bahasa::all();
        } else {
            $menus = Bahasa::where('bahasa', 'like', "%$search%")->get();
        }
        return response()->json(['data' => $menus], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'bahasa' => 'required|string|max:120|unique:bahasa,bahasa',
        ]);

        if ($validate->fails()) {
            return response()->json(['data' => null, 'message' => $validate->errors()->all()], 400);
        }

        try {
            $bahasa = Bahasa::create([
                'bahasa' => $request->bahasa
            ]);

            return response()->json(['message' => 'Menu created successfully', 'data' => $bahasa], 201);
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
            'bahasa' => 'required|string|max:120|unique:bahasa,bahasa,' . $id,
        ]);

        if ($validate->fails()) {
            return response()->json(['data' => null, 'message' => $validate->errors()->all()], 400);
        }

        try {
            $bahasa = Bahasa::where('id', $id)->update([
                'bahasa' => $request->bahasa
            ]);

            return response()->json(['message' => 'Menu Edited successfully', 'data' => $bahasa], 201);
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
            $bahasa = Bahasa::findOrFail($id);
            $bahasa->delete();
            return response()->json(['message' => 'Bahasa deleted successfully', 'data' => null], 200);
        } catch (\Throwable $th) {
            return response()->json(['data' => null, 'message' => $th->getMessage()], 404);
        }
    }
}
