<?php

namespace App\Versions\V1\Repositories;

use App\Models\Offer;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class OfferRepository extends RepositoryContract
{
    public function __construct(
        public Builder $builder
    ) {
        $this->builder = app(Offer::class)->with(['vehicle']);
    }

    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return $this->builder->paginate($perPage);
    }

    public function getMinPerMinute(): int|string
    {
        return $this->builder->min('per_minute');
    }

    public function getMaxPerMinute(): int|string
    {
        return $this->builder->max('per_minute');
    }
}
