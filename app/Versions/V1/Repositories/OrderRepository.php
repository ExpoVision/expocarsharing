<?php

namespace App\Versions\V1\Repositories;

use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use App\Versions\V1\Contracts\RepositoryContract;
use App\Versions\V1\DTO\OrderDto;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class OrderRepository extends RepositoryContract
{
    public function __construct(
        public Order $order,
    ) {
    }

    public function getQuery(): Builder
    {
        return $this->order->newQuery();
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getOffer(): Offer
    {
        return $this->order->offer;
    }

    /**
     * @todo refactor
     */
    public function getOrderByUser(User $user): Order
    {
        return $user->order;
    }

    public function getByStatus(string $status, ?int $perPage = null): LengthAwarePaginator
    {
        return $this->getQuery()->where('status', $status)->paginate($perPage);
    }

    public function getTrashed(?int $perPage = null): LengthAwarePaginator
    {
        return $this->getQuery()->onlyTrashed()->paginate($perPage);
    }

    public function countByStatus(string $status): int
    {
        return $this->getQuery()->where('status', $status)->count();
    }

    public function getById(int $id): Order
    {
        return $this->getQuery()->findOrFail($id);
    }

    public function fill(OrderDto $dto): static
    {
        $this->order->fill($dto->toArray());

        return $this;
    }

    public function updateStatus(string $status): static
    {
        $this->order->setAttribute('status', $status);

        return $this;
    }

    public function startRent(): static
    {
        $this->order->started_at = now();

        return $this;
    }

    public function finishRent(): static
    {
        DB::transaction(function () {
            $this->order->finished_at = now();
            $this->updateStatus(Order::STATUS_FINISH);
        });

        return $this;
    }

    public function save(): static
    {
        $this->order->save();

        return $this;
    }

    public function delete(): static
    {
        $this->order->delete();

        return $this;
    }
}
