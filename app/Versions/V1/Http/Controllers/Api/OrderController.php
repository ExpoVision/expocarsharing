<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Models\Offer;
use App\Models\Order;
use App\Versions\V1\DTO\OrderDto;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\Collections\Order\OrderConfirmingCollection;
use App\Versions\V1\Http\Resources\Collections\Order\OrderRentedCollection;
use App\Versions\V1\Http\Resources\Collections\Order\OrderReservedCollection;
use App\Versions\V1\Http\Resources\Order\OrderResource;
use App\Versions\V1\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        public OrderService $service
    ) {
    }

    public function show(Request $request, Order $order): OrderResource
    {
        return new OrderResource($order);
    }

    public function reserv(Request $request)
    {
        $order = $this->service->store(OrderDto::fromRequest($request));
    }

    public function reserved(Request $request): OrderReservedCollection
    {
        $orders = $this->orderRepository->getByStatus(Order::STATUS_RESERVED);

        return new OrderReservedCollection($orders);
    }

    public function confirming(Request $request): OrderConfirmingCollection
    {
        $orders = $this->orderRepository->getByStatus(Order::STATUS_CONFIRMING);

        return new OrderConfirmingCollection($orders);
    }

    public function rented(Request $request): OrderRentedCollection
    {
        $orders = $this->orderRepository->getByStatus(Order::STATUS_RENTED);

        return new OrderRentedCollection($orders);
    }
}
