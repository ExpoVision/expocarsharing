<?php

namespace App\Versions\V1\Repositories;

use App\Models\Order;
use App\Models\User;
use App\Versions\V1\Contracts\RepositoryContract;

class OrderRepository extends RepositoryContract
{
    public const MODEL = Order::class;

    public function getOrderByUser(User $user): Order
    {
        return $user->order;
    }
}
