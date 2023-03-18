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
        $vehicle = $this->vehicle->load('info');

        return [
            'vehicle' => new VehicleResource($vehicle),
            'per_minute' => $this->per_minute,
        ];
    }
}
