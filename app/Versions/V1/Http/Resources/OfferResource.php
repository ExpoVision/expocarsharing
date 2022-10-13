<?php

namespace App\Versions\V1\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'vehicle' => new VehicleResource($this->whenLoaded('vehicle')),
            'per_minute' => $this->per_minute . "/" . __('min'),
        ];
    }
}
