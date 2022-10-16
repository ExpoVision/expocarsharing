<?php

namespace App\Versions\V1\Http\Resources\Order;

use App\Versions\V1\Services\PriceService;

class OrderRentedResource extends OrderResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $offer = $this->offer;

        /** @var PriceService $activePrice */
        $activePrice = app(PriceService::class);

        return [
            'status' => $this->status,
            'price' => $activePrice->orderActivePrice($this->resource),
            'time' => $this->active_in->forHumans(),
            'per_minute' => $offer->per_minute,
        ];
    }
}
