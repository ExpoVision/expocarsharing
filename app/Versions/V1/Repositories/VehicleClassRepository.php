<?php

namespace App\Versions\V1\Repositories;

use App\Models\VehicleClass;
use App\Traits\HasFilterFormFill;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleClassRepository
{
    use HasFilterFormFill;

    public function __construct(
        public Builder $builder
    ) {
        $this->builder = app(VehicleClass::class)->query();
    }

    public function certainWithVehicles(?int $perGroup): Collection
    {
        return $this->builder
            ->take(3)
            ->with(['vehicles' => function (HasMany $query) use ($perGroup) {
                $query->latest()->limit($perGroup);
            }])
            ->get();
    }
}
