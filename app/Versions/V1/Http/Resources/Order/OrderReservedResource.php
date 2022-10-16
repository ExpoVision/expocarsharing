<?php

namespace App\Versions\V1\Http\Resources\Order;

use App\Models\Order;
use App\Versions\V1\Http\Resources\VehicleResource;
use App\Versions\V1\Http\Resources\UserResource;
use App\Versions\V1\Http\Resources\OfferResource;

class OrderReservedResource extends OrderResource
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

        $vehicleName = $vehicle->brand->name . " " . $vehicle->brandModel->name;
        $address = '¯\_(ツ)_/¯';
        $courier = '¯\_(ツ)_/¯';

        return [
            'status' => Order::$statuses[$this->status],
            ...compact('vehicleName', 'address', 'courier'),
        ];
    }
}
