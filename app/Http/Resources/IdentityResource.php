<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class IdentityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->load("userName");
        $user = $this->userName;
        return [
            "id" => $this->id,
            "cat_identity" => $this->cat_identity,
            "name" => $user->name,
            "image_url" => $this->image_path
                ? url(Storage::url($this->image_path))
                : null,
        ];
    }
}
