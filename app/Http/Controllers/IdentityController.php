<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Identity;
use App\Http\Resources\IdentityResource;
use App\Http\Resources\LostNameResource;

class IdentityController extends Controller
{
    public function index()
    {
        $identity = Identity::all()->load("userName");
        return response()->json([
            "message" => "Success",
            "code" => 200,
            "data" => IdentityResource::collection($identity)
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "identity_image" =>
                "required|image|mimes:jpeg,png,jpg,gif|max:2048",
            "cat_identity" => "required|string|max:255",
        ]);

        $path = $request
            ->file("identity_image")
            ->storePublicly("identities", "public");
        $identity = Identity::create([
            "image_path" => $path,
            "cat_identity" => $validated["cat_identity"],
            "id_user" => $request->user()->id,
        ]);
        return response()->json([
            "message" => "Success",
            "code" => 200,
            "data" => IdentityResource::make($identity)
        ]);
    }

    public function update(Request $request, $id)
    {
        $identity = Identity::findOrFail($id);

        if ($request->hasFile("identity_image")) {
            $path = $request
                ->file("identity_image")
                ->storePublicly("identities", "public");
            $identity->image_path = $path;
        }
        if ($request->has("cat_identity")) {
            $identity->cat_identity = $request->cat_identity;
        }
        $identity->save();
        return response()->json([
            "message" => "Success",
            "code" => 200,
            "data" => IdentityResource::make($identity)
        ]);
    }

    public function show($id)
    {
        $identity = Identity::findOrFail($id);
        return response()->json([
            "message" => "Success",
            "code" => 200,
            "data" => IdentityResource::make($identity)
        ]);
    }

    public function destory($id)
    {
        $identity = Identity::findOrFail($id);
        $identity->delete();
        return response()->json(["data" => IdentityResource::make($identity)]);
    }
}
