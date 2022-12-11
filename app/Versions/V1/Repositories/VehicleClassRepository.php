<?php

namespace App\Versions\V1\Repositories;

use App\Models\Offer;
use App\Models\VehicleClass;
use App\Traits\HasFilterFormFill;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class VehicleClassRepository extends RepositoryContract
{
    use HasFilterFormFill;

    public function __construct(
        private VehicleClass $vehicleClass
    ) {
    }

    public function getQuery(): Builder
    {
        return $this->vehicleClass->newQuery();
    }

    public function certainWithOffers(?int $perGroup): Collection
    {
        return $this->getQuery()
            ->take(5)
            ->with(['offers' => function (HasManyThrough $query) use ($perGroup) {
                $query
                    ->where('status', Offer::STATUS_AVAILABLE)
                    ->latest()
                    ->limit($perGroup);
            }])
            ->get();
    }
}
