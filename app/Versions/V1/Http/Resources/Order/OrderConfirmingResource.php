<?php

namespace App\Versions\V1\Http\Resources\Order;

use App\Models\Order;
use App\Versions\V1\Services\PriceService;

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
        /** @var Order $order */
        $order = $this->resource;

        /** @var PriceService $finishPrice */
        $finishPrice = app(PriceService::class);

        return [
            'finished_at' => $order->finished_at->diffForHumans($this->started_at),
            'price' => $finishPrice->orderFinishPrice($this->resource),
        ];
    }
}
