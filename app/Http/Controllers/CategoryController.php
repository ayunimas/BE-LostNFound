<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatItem;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index() {
        $catItem = CatItem::all();
        //return response()->json(['data' => $catItem]);
        return CategoryResource::collection($catItem);
    }
}
