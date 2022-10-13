<?php

namespace App\Versions\V1\Repositories;

use App\Models\Feedback;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Pagination\LengthAwarePaginator;

class FeedbackRepository extends RepositoryContract
{
    public const MODEL = Feedback::class;

    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return $this->builder->paginate($perPage);
    }
}
