<?php

namespace App\Versions\V1\Repositories;

use App\Models\Offer;
use App\Versions\V1\Contracts\RepositoryContract;
use App\Versions\V1\DTO\OfferDto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class OfferRepository extends RepositoryContract
{
    public function __construct(
        private Offer $offer,
    ) {
    }

    public function getQuery(): Builder
    {
        return $this->offer->newQuery();
    }

    public function getOffer(): Offer
    {
        return $this->offer;
    }

    public function count(): int
    {
        return $this->getQuery()->count();
    }

    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return $this->getQuery()->paginate($perPage);
    }

    public function getMinPerMinute(): int|string
    {
        return $this->getQuery()->min('per_minute');
    }

    public function getMaxPerMinute(): int|string
    {
        return $this->getQuery()->max('per_minute');
    }

    public function makeUnavailable(): static
    {
        $this->offer->setAttribute('status', Offer::STATUS_UNAVAILABLE);
        $this->save();

        return $this;
    }

    public function makeAvailable(): static
    {
        $this->offer->setAttribute('status', Offer::STATUS_AVAILABLE);
        $this->save();

        return $this;
    }

    public function save(): void
    {
        $this->offer->save();
    }
}
