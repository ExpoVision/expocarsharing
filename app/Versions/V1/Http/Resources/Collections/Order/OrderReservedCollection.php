<?php

namespace App\Versions\V1\Http\Resources\Collections\Order;

use App\Versions\V1\Http\Resources\Order\OrderReservedResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderReservedCollection extends ResourceCollection
{
    public $collects = OrderReservedResource::class;
}
