<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatItem;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index()
    {
        $catItem = CatItem::all();
        return response()->json([
            "data" => CategoryResource::collection($catItem),
            "message" => "Success",
            "code" => 200
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "nm_cat" => "required|string|max:255",
        ]);

        $catItem = CatItem::create($validatedData);

        return response()->json([
            "data" => new CategoryResource($catItem),
            "message" => "Success",
            "code" => 200
        ], 201);
        //return response()->json(["data" => $catItem], 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "nm_cat" => "required|string|max:255",
        ]);

        $catItem = CatItem::findOrFail($id);
        $catItem->update($validatedData);

        return response()->json([
            "data" => new CategoryResource($catItem),
            "message" => "Success",
            "code" => 200
        ], 200);
        //return response()->json(["data" => $catItem], 200);
    }

    public function destroy($id)
    {
        $catItem = CatItem::findOrFail($id);
        $catItem->delete();

        return response()->json(
            ["message" => "Category deleted successfully"],
            200
        );
    }

    public function show($id)
    {
        $catItem = CatItem::findOrFail($id);
        //return response()->json(["data" => $catItem], 200);
        return response()->json([
            "data" => new CategoryResource($catItem),
            "message" => "Success",
            "code" => 200
        ], 200);
    }
}
