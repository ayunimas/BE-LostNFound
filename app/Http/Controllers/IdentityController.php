<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Identity;
use App\Http\Resources\IdentityResource;
use App\Http\Resources\LostNameResource;

class IdentityController extends Controller
{
    public function index() {
        $identity = Identity::all()->load('userName');
        return response()->json(['data' => IdentityResource::collection($identity)]);
    }
}
