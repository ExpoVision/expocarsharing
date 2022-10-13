<?php

namespace App\Versions\V1\Repositories;

use App\Models\VehicleClass;
use App\Traits\HasFilterFormFill;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleClassRepository extends RepositoryContract
{
    use HasFilterFormFill;

    public const MODEL = VehicleClass::class;

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
