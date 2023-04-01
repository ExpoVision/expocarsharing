<?php

namespace App\Versions\V1\Services;

use App\Models\UserPay;
use App\Versions\V1\DTO\UserPayDto;
use App\Versions\V1\Repositories\UserPayRepository;

class UserPayService
{
    public function __construct(
        private UserPay $userPay,
        private UserPayRepository $repository,
    )
    {
        $this->repository = app(UserPayRepository::class, compact('userPay'));
    }

    public function store(UserPayDto $dto): static
    {
        $this->repository
            ->updateOrCreate($dto)
            ->save();

        return $this;
    }
}
