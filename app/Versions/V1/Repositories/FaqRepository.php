<?php

namespace App\Versions\V1\Repositories;

use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Pagination\LengthAwarePaginator;

class FaqRepository extends RepositoryContract
{
    public function paginate(?int $perPage): LengthAwarePaginator
    {
        return $this->builder->paginate($perPage);
    }
}
