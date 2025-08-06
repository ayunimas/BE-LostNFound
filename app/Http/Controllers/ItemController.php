<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use App\Http\Resources\CategoryNameResource;

class ItemController extends Controller
{
    public function index () {

        $item = item::all()->load('catItem');
        return response()->json([
            "message" => "Success",
            "code" => 200,
            'data' => ItemResource::collection($item)
        ]);
        //return ItemResource::collection($item);
        //return response()->json(['data' => $item]);

    }
}
