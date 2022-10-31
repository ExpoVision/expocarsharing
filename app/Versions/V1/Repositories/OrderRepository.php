<?php

namespace App\Versions\V1\Repositories;

use App\Models\Order;
use App\Models\User;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository extends RepositoryContract
{
    public const MODEL = Order::class;

    public function __construct(
        public Builder $builder
    ) {
        $this->builder = app(self::MODEL)->with([
            'user',
            'offer',
            'vehicle',
        ]);
    }

    public function getOrderByUser(User $user): Order
    {
        return $user->order;
    }

    public function getByStatus(string $status, ?int $perPage = null): LengthAwarePaginator
    {
        return $this->builder->where('status', $status)->paginate($perPage);
    }

    public function getById(int $id): Order
    {
        return $this->builder->findOrFail($id);
    }
}
