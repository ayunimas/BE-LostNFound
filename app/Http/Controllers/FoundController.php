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
}
