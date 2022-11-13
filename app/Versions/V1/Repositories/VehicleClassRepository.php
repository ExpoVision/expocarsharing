<?php

namespace App\Versions\V1\Repositories;

use App\Models\VehicleClass;
use App\Traits\HasFilterFormFill;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function certainWithVehicles(?int $perGroup): Collection
    {
        return $this->getQuery()
            ->take(3)
            ->with(['vehicles' => function (HasMany $query) use ($perGroup) {
                $query->latest()->limit($perGroup);
            }])
            ->get();
    }
}
