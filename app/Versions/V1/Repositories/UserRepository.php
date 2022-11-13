<?php

namespace App\Versions\V1\Repositories;

use App\Models\User;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Sanctum\NewAccessToken;

class UserRepository extends RepositoryContract
{
    public function __construct(
        private User $user
    ) {
    }

    public function getQuery(): Builder
    {
        return $this->user->newQuery();
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function fill(array $user): static
    {
        $this->user->fill($user);

        return $this;
    }

    public function save(): static
    {
        $this->user->save();

        return $this;
    }

    public function createToken(array $abilities = ['*']): NewAccessToken
    {
        return $this->user->createToken($this->user->email, $abilities);
    }
}
