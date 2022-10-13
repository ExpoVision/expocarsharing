<?php

namespace App\Versions\V1\Repositories;

use App\Models\Offer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class OfferRepository
{
    public function __construct(
        public Builder $offer
    ) {
        $this->offer = app(Offer::class)->with(['vehicle']);
    }

    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return $this->offer->paginate($perPage);
    }

    public function getMinPerMinute(): int|string
    {
        return $this->offer->min('per_minute');
    }

    public function getMaxPerMinute(): int|string
    {
        return $this->offer->max('per_minute');
    }
}
