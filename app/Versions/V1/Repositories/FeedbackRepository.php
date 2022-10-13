<?php

namespace App\Versions\V1\Repositories;

use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Pagination\LengthAwarePaginator;

class FeedbackRepository extends RepositoryContract
{
    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return $this->builder->paginate($perPage);
    }
}