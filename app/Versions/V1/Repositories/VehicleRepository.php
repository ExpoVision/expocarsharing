<?php

namespace App\Versions\V1\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;

class VehicleRepository
{
    public function __construct(
        public Vehicle $vehicle,
        public Builder $vehicleBuilder
    ) {
        $this->vehicleBuilder = $this->vehicle->with(['brand', 'brandModel', 'color']);
    }

    /**
     * @param int|null $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return $this->vehicleBuilder->paginate($perPage);
    }
}
