<?php

namespace App\Versions\V1\Http\Resources\Order;

use App\Versions\V1\DTO\OfferDto;
use App\Versions\V1\DTO\OrderDto;
use App\Versions\V1\Http\Resources\OfferResource;
use App\Versions\V1\Http\Resources\UserResource;
use App\Versions\V1\Http\Resources\VehicleResource;
use App\Versions\V1\Services\PriceService;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderFinishResource extends JsonResource
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

        /** @var PriceService $finishPrice */
        $finishPrice = app(PriceService::class)->orderFinishPrice($orderDto, $offerDto);

        return [
            'id' => $this->id,
            'status' => $this->status,
            'price' => $finishPrice,
            ...compact('vehicle', 'user', 'offer'),
        ];
    }
}
