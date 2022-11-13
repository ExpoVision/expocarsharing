<?php

namespace App\Versions\V1\Repositories;

use App\Models\Feedback;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class FeedbackRepository extends RepositoryContract
{
    public function __construct(
        private Feedback $feedback
    ) {
    }

    public function getQuery(): Builder
    {
        return $this->feedback->newQuery();
    }

    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return $this->getQuery()->paginate($perPage);
    }
}
