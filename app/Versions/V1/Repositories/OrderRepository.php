<?php

namespace App\Versions\V1\Repositories;

use App\Models\Order;
use App\Models\User;
use App\Versions\V1\Contracts\RepositoryContract;
use App\Versions\V1\DTO\OrderDto;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository extends RepositoryContract
{
    // public const MODEL = Order::class;

    public function __construct(
        public Order $order,
        // public Builder $builder
    ) {
        // $this->builder = app(self::MODEL)->with([
        //     'user',
        //     'offer',
        //     'vehicle',
        // ]);
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
        return $this->order->newQuery()->where('status', $status)->paginate($perPage);
    }

    public function getById(int $id): Order
    {
        return $this->order->newQuery()->findOrFail($id);
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
        $this->order->finished_at = now();

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
