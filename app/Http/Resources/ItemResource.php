<?php

namespace App\Http\Resources;
use App\Http\Resources\CategoryNameResource;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $category = $this->whenLoaded('catItem');
        return [
            'id' => $this->id,
            'nm_item' => $this->nm_item,
            'color' => $this->color,
            'brand' => $this->brand,
            'weight' => $this->weight,
            'itemable_type' => $this->itemable_type,
            'itemable_id' => $this->itemable_id,
            'categories' => $category->nm_cat

        ];
    }
}
