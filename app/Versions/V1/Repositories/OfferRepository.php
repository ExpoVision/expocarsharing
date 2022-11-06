<?php

namespace App\Versions\V1\Repositories;

use App\Models\Offer;
use App\Versions\V1\Contracts\RepositoryContract;
use App\Versions\V1\DTO\OfferDto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class OfferRepository extends RepositoryContract
{
    // public const MODEL = Offer::class;

    public function __construct(
        private Offer $offer,
        // public Builder $builder
    ) {
        // $this->builder = app(self::MODEL)->with(['vehicle']);
    }

    public function getOffer(): Offer
    {
        return $this->offer;
    }

    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return $this->offer->newQuery()->paginate($perPage);
    }

    public function getMinPerMinute(): int|string
    {
        return $this->offer->newQuery()->min('per_minute');
    }

    public function getMaxPerMinute(): int|string
    {
        return $this->offer->newQuery()->max('per_minute');
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
