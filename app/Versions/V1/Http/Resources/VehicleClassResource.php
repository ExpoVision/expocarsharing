<?php

namespace App\Versions\V1\Http\Resources;

use App\Versions\V1\Http\Resources\Collections\OfferCollection;
use App\Versions\V1\Http\Resources\Collections\VehicleCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleClassResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'vehicles' => new VehicleCollection($this->whenLoaded('vehicles')),
            'offers' => new OfferCollection($this->whenLoaded('offers')),
        ];
    }
}
