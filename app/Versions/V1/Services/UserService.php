<?php

namespace App\Versions\V1\Services;

use App\Versions\V1\Repositories\UserRepository;
use App\Models\User;
use App\Versions\V1\DTO\AdminDto;
use App\Versions\V1\DTO\UserDto;
use Laravel\Sanctum\NewAccessToken;

class UserService
{
    private UserRepository $repository;

    public function __construct(
        private User $user
    ) {
        $this->repository = app(UserRepository::class, compact('user'));
    }

    public function getUser()
    {
        return $this->user;
    }

    public function store(UserDto $data): static
    {
        $this->repository
            ->fill($data->toArray())
            ->save();

        return $this;
    }

    public function update(UserDto $data): static
    {
        $this->repository
            ->fill($data->toUpdateArray())
            ->save();

        return $this;
    }

    public function storeAdmin(AdminDto $data): static
    {
        $this->repository
            ->fill($data->toArray())
            ->save();

        // some new admin policies or else...
        return $this;
    }

    public function delete(): static
    {
        $this->repository->delete();

        return $this;
    }

    public function createToken(array $abilities = ['*']): NewAccessToken
    {
        return $this->repository->createToken($abilities);
    }
}
