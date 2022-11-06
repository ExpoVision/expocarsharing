<?php

namespace App\Versions\V1\Services;

use App\Models\Order;
use App\Versions\V1\DTO\OrderDto;
use App\Versions\V1\Repositories\OrderRepository;

class OrderService
{
    private OrderRepository $repository;

    public function __construct(
        private Order $order
    ) {
        $this->repository = app(OrderRepository::class, ['order' => $this->order]);
    }

    public function store(OrderDto $dto): Order
    {
        $this->repository->fill($dto)->save();

        return $this->order;
    }
}
