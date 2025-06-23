<?php

namespace App\Http\Resources;

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
        $this->loadMissing(["userName", "Found", "Identity"]);
        $found = $this->Found;
        $identity = $this->Identity;
        $identity->loadMissing("userName");
        $user = $this->whenLoaded("userName");
        return [
            "id" => $this->id,
            "date_req" => $this->created_at,
            "status" => $this->status,
            "id_found" => $found->id,
            "nm_item" => $found->item->nm_item,
            "cat_identity" => $identity->cat_identity,
            "name_req" => $user->name,
        ];
    }
}
