<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Found;
use App\Models\Identity;
use App\Models\Pickup;
use App\Http\Resources\PickupResource;

class PickupController extends Controller
{
    public function index () {
        $pickup = Pickup::all()->load('userName','Found','Identity');
        return response()->json(['data' => PickupResource::collection($pickup)]);
    }
}
