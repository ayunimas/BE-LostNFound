<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return UserResource::collection($user);
        //return response()->json([$user]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "name" => "required|string|max:255",
            "contact" => "required|string|unique:user"
        ]);

        $user = User::findOrFail($id);
        $user->update($validatedData);

        return response()->json(["data" => $user], 200);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(["data" => $user], 200);
    }
}
