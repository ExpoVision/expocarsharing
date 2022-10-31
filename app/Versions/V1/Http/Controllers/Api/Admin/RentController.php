<?php

namespace App\Versions\V1\Http\Controllers\Api\Admin;

use App\Models\Order;
use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\Collections\Order\OrderConfirmingCollection;
use App\Versions\V1\Http\Resources\Collections\Order\OrderRentedCollection;
use App\Versions\V1\Http\Resources\Collections\Order\OrderReservedCollection;
use App\Versions\V1\Http\Resources\Order\OrderResource;
use App\Versions\V1\Repositories\OrderRepository;
use App\Versions\V1\Repositories\VehicleRepository;
use Illuminate\Http\Request;

class RentController extends Controller
{
    public function __construct(
        public VehicleRepository $vehicleRepository,
        public OrderRepository $orderRepository,
    ) {
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
