<?php

namespace App\Versions\V1\Http\Resources\Order;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Versions\V1\Http\Resources\VehicleResource;
use App\Versions\V1\Http\Resources\UserResource;
use App\Versions\V1\Http\Resources\OfferResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $vehicle = $this->vehicle;
        $user = $this->user;
        $offer = $this->offer;

        return [
            'id' => $this->id,
            'vehicle' => new VehicleResource($vehicle),
            'user' => new UserResource($user),
            'offer' => new OfferResource($offer),
            'status' => $this->status,
        ];
    }
}
