<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if (!($token = auth()->attempt($credentials))) {
            return response()->json(["error" => "Unauthorized"], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required|string|max:255",
            "contact" => "required|string|unique:user",
            "email" => "required|email|unique:user",
            "password" => "required|string|min:8",
        ]);

        $roleCivitas = Role::where("nm_role", "satpam")->first();

        $user = User::create([
            "name" => $validatedData["name"],
            "contact" => $validatedData["contact"],
            "email" => $validatedData["email"],
            "password" => Hash::make($validatedData["password"]),
            "id_role" => $roleCivitas->id,
        ]);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(["message" => "Successfully logged out"]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            "access_token" => $token,
            "token_type" => "bearer",
            "expires_in" => auth()->factory()->getTTL() * 60,
            "user" => auth()->user(),

        ]);
    }
}
