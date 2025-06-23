<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pickup;
use App\Http\Resources\PickupResource;

class PickupController extends Controller
{
    public function index()
    {
        $pickup = Pickup::all()->load("userName", "Found", "Identity");
        return response()->json([
            "data" => PickupResource::collection($pickup),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "id_found" => "required|exists:found,id",
            "id_person" => "required|exists:identity_person,id",
        ]);

        $pickup = Pickup::create([
            "id_found" => $validated["id_found"],
            "id_person" => $validated["id_person"],
            "status" => "waiting_approval",
        ]);

        return response()->json(["data" => new PickupResource($pickup)]);
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            "status" => "required|in:waiting_approval,approved,rejected",
        ]);

        $pickup = Pickup::findOrFail($id);

        $pickup->update([
            "status" => $validated["status"],
        ]);

        return response()->json(["data" => new PickupResource($pickup)]);
    }

    public function show($id)
    {
        $pickup = Pickup::findOrFail($id);

        return response()->json(["data" => new PickupResource($pickup)]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "id_found" => "required|exists:found,id",
            "id_person" => "required|exists:identity_person,id",
        ]);

        $pickup = Pickup::findOrFail($id);

        $pickup->update([
            "id_found" => $validated["id_found"],
            "id_person" => $validated["id_person"],
        ]);

        return response()->json(["data" => new PickupResource($pickup)]);
    }

    public function destroy($id)
    {
        $pickup = Pickup::findOrFail($id);

        $pickup->delete();

        return response()->json(["message" => "Pickup deleted successfully"]);
    }
}
