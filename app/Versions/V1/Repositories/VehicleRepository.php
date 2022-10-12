<?php

namespace App\Versions\V1\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class VehicleRepository
{
    public function __construct(
        public Builder $vehicle,
        public VehicleClassRepository $classRepository,
    ) {
        $this->vehicle = app(Vehicle::class)->with(['brand', 'brandModel', 'color', 'class']);
    }

    /**
     * @param int|null $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return $this->vehicle->paginate($perPage);
    }

    public function groupedByClass(?int $perGroup = null): Collection
    {
        return $this->classRepository->certainWithVehicles($perGroup);
    }
}
