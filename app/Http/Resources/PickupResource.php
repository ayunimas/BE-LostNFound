<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class PickupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->loadMissing(["Found", "Identity"]);
        $found = $this->Found;
        $identity = $this->Identity;
        $identity->loadMissing("userName");
        $user = $identity->userName;
        return [
            "id" => $this->id,
            "date_req" => $this->created_at,
            "status" => $this->status,
            "id_found" => $found->id,
            "image_path" => $identity->image_path
                ? url(Storage::url($identity->image_path))
                : null,
            "nm_item" => $found->item->nm_item,
            "cat_identity" => $identity->cat_identity,
            "name_req" => $user->name,
        ];
    }
}
