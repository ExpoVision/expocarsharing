<?php

namespace App\Versions\V1\Http\Resources\Order;

class OrderConfirmingResource extends OrderResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return new OrderResource($this);
    }
}
