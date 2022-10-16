<?php

namespace App\Versions\V1\Http\Resources\Order;

use App\Models\Order;

class OrderResourceFactory
{
    public static function create(string $factory, Order $order): OrderResource
    {
        $orderResourceClass = '';

        switch ($factory) {
            case Order::STATUS_BROKEN:
                $orderResourceClass = OrderBrokenResource::class;
                break;
            case Order::STATUS_CONFIRMING:
                $orderResourceClass = OrderConfirmingResource::class;
                break;
            case Order::STATUS_ERROR:
                $orderResourceClass = OrderErrorResource::class;
                break;
            case Order::STATUS_RENTED:
                $orderResourceClass = OrderRentedResource::class;
                break;
            case Order::STATUS_RESERVED:
                $orderResourceClass = OrderReservedResource::class;
                break;
        }

        return new $orderResourceClass($order);
    }
}
