<?php

namespace App\Versions\V1\Http\Controllers\Api;

use App\Versions\V1\Http\Controllers\Controller;
use App\Versions\V1\Http\Resources\OrderResource;
use App\Versions\V1\Http\Resources\UserResource;
use App\Versions\V1\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct(
        public UserRepository $repository
    ) {
    }

    public function show(int $user): UserResource
    {
        return new UserResource($this->repository->getById($user));
    }

    public function getCurrentUserOrder(): ?OrderResource
    {
        if (!auth()->hasUser()) {
            return null;
        }

        $id = auth()->user()->id;

        return new OrderResource($this->repository->getOrderByUserId($id));
    }
}
