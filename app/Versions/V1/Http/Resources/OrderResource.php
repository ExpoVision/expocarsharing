<?php

namespace App\Versions\V1\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

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
            // 'address' => ...,
            'vehicle' => new VehicleResource($vehicle),
            'user' => new UserResource($user),
            'offer' => new OfferResource($offer),
            'status' => Order::$statuses[$this->status],
            'active_in' => $this->active_in,
        ];
    }
}
