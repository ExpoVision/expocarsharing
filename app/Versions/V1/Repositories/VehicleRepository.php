<?php

namespace App\Versions\V1\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;

class VehicleRepository
{
    public function __construct(
        public Builder $vehicle,
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
}
