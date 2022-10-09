<?php

namespace App\Versions\V1\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Vehicle;

class VehicleRepository
{
    public function __construct(
        protected Vehicle $vehicle
    ) {
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
