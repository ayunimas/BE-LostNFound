<?php

namespace App\Http\Resources;

use App\Http\Resources\LostNameResource;
use App\Http\Resource\ItemResource;
use App\Http\Resources\CategoryNameResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class FoundResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = $this->whenLoaded('userName');
        $item = $this->whenLoaded('item');
        return [
            'id' => $this->id,
            'date_found' => $this->date_found,
            'location' => $this->location,
            'userName' => $user->name,
            'idItem' => $item->id,
            'nm_item' => $item->nm_item,
            'color' => $item->color,
            'brand' => $item->brand,
            'weight' => $item->weight,
            'id_catItem' => $item->catItem->nm_cat,
            'image_url' => $item->image_path
                ? url(Storage::url($item->image_path))
                : null,
            'itemable_type' => $item->itemable_type,
            'itemable_id' => $item->itemable_id
        ];
    }
}
