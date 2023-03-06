<?php

namespace App\Versions\V1\Services;

use App\Models\Order;
use App\Versions\V1\DTO\OrderDto;
use App\Versions\V1\Repositories\OfferRepository;
use App\Versions\V1\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;

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

    public function cancel(): Order
    {
        $offer = $this->repository->getOffer();
        /** @var OfferRepository $offerRepository */
        $offerRepository = app(OfferRepository::class, compact('offer'));

        DB::transaction(function() use ($offerRepository) {
            $this->repository->updateStatus(Order::STATUS_CANCELED)->save();
            $this->repository->delete();

            $offerRepository->makeAvailable();
        });

        return $this->order;
    }
}
