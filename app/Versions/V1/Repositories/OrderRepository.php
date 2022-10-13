<?php

namespace App\Versions\V1\Repositories;

use App\Models\Order;
use App\Versions\V1\Contracts\RepositoryContract;

class OrderRepository extends RepositoryContract
{
    public const MODEL = Order::class;
}
