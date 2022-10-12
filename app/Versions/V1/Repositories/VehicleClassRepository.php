<?php

namespace App\Versions\V1\Repositories;

use App\Models\VehicleClass;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleClassRepository
{
    public VehicleClass $class;

    public function __construct(
        public VehicleClass $vehicleClass
    ) {
        $this->class = $vehicleClass;
    }

    public function certainWithVehicles(?int $perGroup): Collection
    {
        return $this->class
            ->take(3)
            ->with(['vehicles' => function (HasMany $query) use ($perGroup) {
                $query->latest()->limit($perGroup);
            }])
            ->get();
    }
}
