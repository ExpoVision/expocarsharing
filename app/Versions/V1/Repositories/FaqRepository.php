<?php

namespace App\Versions\V1\Repositories;

use App\Models\Faq;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class FaqRepository extends RepositoryContract
{
    public function __construct(
        private Faq $faq
    ) {
    }

    public function getQuery(): Builder
    {
        return $this->faq->newQuery();
    }

    public function paginate(?int $perPage): LengthAwarePaginator
    {
        return $this->getQuery()->paginate($perPage);
    }
}
