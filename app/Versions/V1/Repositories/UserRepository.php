<?php

namespace App\Versions\V1\Repositories;

use App\Models\User;
use App\Versions\V1\Contracts\RepositoryContract;

class UserRepository extends RepositoryContract
{
    public const MODEL = User::class;

    public function getById(int $id): User
    {
        return $this->builder->findOrFail($id);
    }
}
