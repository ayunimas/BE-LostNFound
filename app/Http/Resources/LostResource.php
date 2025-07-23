<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class LostResource extends JsonResource
{
    public function toArray($request)
    {
        $user = $this->whenLoaded("userName");
        $item = $this->whenLoaded("item");
        return [
            "id" => $this->id,
            "date_lost" => $this->date_lost,
            "location" => $this->location,
            "userName" => $user->name,
            "idItem" => $item->id,
            "nm_item" => $item->nm_item,
            "color" => $item->color,
            "brand" => $item->brand,
            "weight" => $item->weight,
            "id_catItem" => $item->catItem->nm_cat,
            "image_url" => $item->image_path
                ? url(Storage::url($item->image_path))
                : null,
            "itemable_type" => $item->itemable_type,
            "itemable_id" => $item->itemable_id,
        ];
    }
}
