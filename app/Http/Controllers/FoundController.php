<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Found;
use App\Http\Resources\FoundResource;


class FoundController extends Controller
{
    public function index () {
        $found = Found::all()->load('userName','item');
        return response()->json(['data' => FoundResource::collection($found)]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "date_found" => "required|date",
            "location" => "required|string|max:255",
            "id_catItem" => "required|exists:category_item,id",
            "nm_item" => "required|string|max:255",
            "color" => "required|string|max:255",
            "brand" => "required|string|max:255",
            "weight" => "required|string|max:255",
            "image" =>
                "required|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        $foundParam = [
            "date_found" => new \DateTime($validated["date_found"]),
            "location" => $validated["location"],
            "id_user" => $request->user()->id,
        ];
        $found = Found::create($foundParam);

        $path = $request
            ->file("image")
            ->storePublicly("found", "public");
        $itemParam = [
            "nm_item" => $validated["nm_item"],
            "color" => $validated["color"],
            "brand" => $validated["brand"],
            "weight" => $validated["weight"],
            "image_path" => $path, //ini
            "id_catItem" => $validated["id_catItem"],
        ];

        $found->item()->create($itemParam);

        $found->load("userName");
        $found->load("item");
        return response()->json(["data" => new FoundResource($found)]);
    }

    public function show($id)
    {
        $found = Found::findOrFail($id);
        $found->load("userName");
        $found->load("item");
        return response()->json(["data" => new FoundResource($found)]);
    }

    public function update(Request $request, $id)
    {
        $request->user()->load("role");
        if ($request->user()->role->nm_role != "satpam") {
            return response()->json(["message" => "Unauthorized"], 403);
        }

        $validated = $request->validate([
            "date_found" => "nullable|string",
            "location" => "nullable|string|max:255",
            "id_catItem" => "nullable|exists:category_item,id",
            "nm_item" => "nullable|string|max:255",
            "color" => "nullable|string|max:255",
            "brand" => "nullable|string|max:255",
            "weight" => "nullable|string|max:255",
        ]);

        $foundParam = [
            "date_found" => new \DateTime($validated["date_found"]),
            "location" => $validated["location"],
            "id_user" => $request->user()->id,
        ];
        $found = Found::findOrFail($id);
        $found->load("userName");
        $found->load("item");
        $found->update($foundParam);

        $itemParam = [
            "nm_item" => $validated["nm_item"],
            "color" => $validated["color"],
            "brand" => $validated["brand"],
            "weight" => $validated["weight"],
            "id_catItem" => $validated["id_catItem"],
        ];

        $found->item->update($itemParam);

        $found->load("userName");
        $found->load("item");
        return response()->json(["data" => new FoundResource($found)]);
    }
}


