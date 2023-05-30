<?php

namespace App\Versions\V1\Http\Resources\Order;

class OrderConfirmingResource extends OrderResource
{
    public $collects = OrderResource::class;
}
