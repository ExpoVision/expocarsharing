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

    public function confirmRent(): Order
    {
        $this->repository
            ->updateStatus(Order::STATUS_CONFIRMING_RENT)
            ->save();

        return $this->repository->getOrder();
    }

    public function confirmPayment(): Order
    {
        $this->repository
            ->updateStatus(Order::STATUS_CONFIRMING_PAYMENT)
            ->save();

        return $this->repository->getOrder();
    }

    public function rent()
    {
        DB::transaction(function () {
            $this->repository
                ->startRent()
                ->updateStatus(Order::STATUS_RENTED)
                ->save();
        });

        return $this->repository->getOrder();
    }

    public function finish()
    {
        /** @var OfferRepository $offerRepository */
        $offerRepository = app(OfferRepository::class, [
            'offer' => $this->repository->getOffer()
        ]);

        DB::transaction(function () use ($offerRepository) {
            $this->repository
                ->finishRent()
                ->save()
                ->delete();

            $offerRepository->makeAvailable();
        });

        return $this->repository->getOrder();
    }

    public function cancel(): Order
    {
        /** @var OfferRepository $offerRepository */
        $offerRepository = app(OfferRepository::class, [
            'offer' => $this->repository->getOffer(),
        ]);

        DB::transaction(function () use ($offerRepository) {
            $this->repository
                ->updateStatus(Order::STATUS_CANCELED)
                ->save()
                ->delete();

            $offerRepository->makeAvailable();
        });

        return $this->order;
    }

    public function forceCancel(): Order
    {
        return $this->cancel();
    }
}
