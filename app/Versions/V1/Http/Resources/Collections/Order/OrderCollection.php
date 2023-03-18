<?php

namespace App\Versions\V1\Http\Resources\Collections\Order;

use App\Versions\V1\Http\Resources\Order\OrderResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    public $collects = OrderResource::class;
}
