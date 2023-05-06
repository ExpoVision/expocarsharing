<?php

namespace App\Versions\V1\Http\Resources\Order;

use App\Versions\V1\DTO\OfferDto;
use App\Versions\V1\DTO\OrderDto;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Versions\V1\Http\Resources\VehicleResource;
use App\Versions\V1\Http\Resources\UserResource;
use App\Versions\V1\Http\Resources\OfferResource;
use App\Versions\V1\Services\PriceService;

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
        $vehicle = new VehicleResource($this->vehicle);
        $user = new UserResource($this->user);
        $offer = new OfferResource($this->offer);

        $orderDto = new OrderDto($this->resource->toArray());
        $offerDto = new OfferDto($offer->resource->toArray());

        /** @var PriceService $activePrice */
        $activePrice = app(PriceService::class)->orderActivePrice($orderDto, $offerDto);

        return [
            'id' => $this->id,
            'time' => $this->active_in->forHumans(),
            'active_price' => $activePrice,
            'active_in' => $this->active_in,
            'vehicle' => $vehicle,
            'user' => $user,
            'offer' => $offer,
            'status' => $this->status,
        ];
    }
}
