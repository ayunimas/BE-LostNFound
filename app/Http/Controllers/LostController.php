<?php

namespace App\Http\Controllers;

use App\Models\Lost;
use Illuminate\Http\Request;
use App\Http\Resources\LostResource;

class LostController extends Controller
{
    public function index()
    {
        $lost = Lost::all()->load("userName", "item");
        return response()->json(["data" => LostResource::collection($lost)]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "date_lost" => "required|date",
            "location" => "required|string|max:255",
            "id_catItem" => "required|exists:category_item,id",
            "nm_item" => "required|string|max:255",
            "color" => "required|string|max:255",
            "brand" => "required|string|max:255",
            "weight" => "required|string|max:255",
            "image" =>
                "required|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        $lostParam = [
            "date_lost" => new \DateTime($validated["date_lost"]),
            "location" => $validated["location"],
            "id_user" => $request->user()->id,
        ];
        $lost = Lost::create($lostParam);

        $path = $request
            ->file("image")
            ->storePublicly("lost", "public");
        $itemParam = [
            "nm_item" => $validated["nm_item"],
            "color" => $validated["color"],
            "brand" => $validated["brand"],
            "weight" => $validated["weight"],
            "image_path" => $path,
            "id_catItem" => $validated["id_catItem"],
        ];

        $lost->item()->create($itemParam);

        $lost->load("userName");
        $lost->load("item");
        return response()->json(["data" => new LostResource($lost)]);
    }

    public function show($id)
    {
        $lost = Lost::findOrFail($id);
        $lost->load("userName");
        $lost->load("item");
        return response()->json(["data" => new LostResource($lost)]);
    }

    public function update(Request $request, $id)
    {
        /*$request->user()->load("role");
        if ($request->user()->role->nm_role != "satpam") {
            return response()->json(["message" => "Unauthorized"], 403);
        }*/

        $validated = $request->validate([
            "date_lost" => "nullable|date",
            "location" => "nullable|string|max:255",
            "id_catItem" => "nullable|exists:category_item,id",
            "nm_item" => "nullable|string|max:255",
            "color" => "nullable|string|max:255",
            "brand" => "nullable|string|max:255",
            "weight" => "nullable|string|max:255",
        ]);

        $lostParam = [
            "date_lost" => new \DateTime($validated["date_lost"]),
            "location" => $validated["location"],
            "id_user" => $request->user()->id,
        ];
        $lost = Lost::findOrFail($id);
        $lost->load("userName");
        $lost->load("item");
        $lost->update($lostParam);

        $itemParam = [
            "nm_item" => $validated["nm_item"],
            "color" => $validated["color"],
            "brand" => $validated["brand"],
            "weight" => $validated["weight"],
            "id_catItem" => $validated["id_catItem"],
        ];

        $lost->item()->update($itemParam);

        $lost->load("userName");
        $lost->load("item");
        return response()->json(["data" => new LostResource($lost)]);
    }
}
