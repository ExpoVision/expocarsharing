<?php

namespace App\Versions\V1\Repositories;

use App\Models\UserPay;
use App\Versions\V1\Contracts\RepositoryContract;
use App\Versions\V1\DTO\UserPayDto;
use Illuminate\Database\Eloquent\Builder;

class UserPayRepository extends RepositoryContract
{
    public function __construct(
        private UserPay $userPay
    ) {
    }

    public function getQuery(): Builder
    {
        return $this->userPay->newQuery();
    }

    public function updateOrCreate(UserPayDto $dto): static
    {
        $this->userPay = $this->userPay->updateOrCreate(
            ['user_id' => $dto->user_id],
            $dto->onlyFilled(),
        );

        return $this;
    }

    public function fill(UserPayDto $dto): static
    {
        $this->userPay->fill($dto->toArray());

        return $this;
    }

    public function save(): static
    {
        $this->userPay->save();

        return $this;
    }
}
