<?php

namespace App\Versions\V1\Http\Resources\Collections\Order;

use App\Versions\V1\Http\Resources\Order\OrderRentedResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderRentedCollection extends ResourceCollection
{
    public $collects = OrderRentedResource::class;
}
