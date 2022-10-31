<?php

namespace App\Versions\V1\Http\Resources\Collections\Order;

use App\Versions\V1\Http\Resources\Order\OrderConfirmingResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderConfirmingCollection extends ResourceCollection
{
    public $collects = OrderConfirmingResource::class;
}
