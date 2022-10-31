<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Models\Order;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\Order\OrderResource;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(Request $request, Order $order): OrderResource
    {
        return new OrderResource($order);
    }
}
