<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\OrderResource;
use App\Versions\V1\Http\Resources\UserResource;
use App\Versions\V1\Repositories\OrderRepository;
use App\Versions\V1\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        public UserRepository $repository,
        public OrderRepository $orderRepository,
    ) {
    }

    public function show(Request $request, int $user): UserResource
    {
        return new UserResource($this->repository->getById($user));
    }

    public function getCurrentUserOrder(Request $request): ?OrderResource
    {
        if (!auth()->hasUser()) {
            return null;
        }

        $user = auth()->user();

        return new OrderResource($this->orderRepository->getOrderByUser($user));
    }
}
