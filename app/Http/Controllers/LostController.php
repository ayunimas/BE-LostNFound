<?php

namespace App\Http\Controllers;

use App\Models\Lost;
use Illuminate\Http\Request;
use App\Http\Resources\LostResource;

class LostController extends Controller
{
    public function index () {
        
        $lost = Lost::all()->load('userName','item');
        return response()->json(['data' => LostResource::collection($lost)]);
    }
}
