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
        $found = $this->whenLoaded('Found');
        $user = $this->whenLoaded('userName');
        $identity = $this->whenLoaded('Identity');
        return [
            'id' => $this->id,
            'date_req' => $this->date_req,
            'status' => $this->status,
            'id_found' => $found->id,
            'nm_item' => $found->item->nm_item,
            'cat_identity' => $identity->cat_identity,
            'name_req' => $user->name
        ];
    }
}
