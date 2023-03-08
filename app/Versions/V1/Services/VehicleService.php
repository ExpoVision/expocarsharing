<?php

namespace App\Versions\V1\Services;

use App\Models\Vehicle;
use App\Versions\V1\Repositories\VehicleRepository;

class VehicleService
{
    private VehicleRepository $repository;

    public function __construct(
        private Vehicle $vehicle
    ) {
        $this->repository = app(VehicleRepository::class, compact('vehicle'));
    }

    public function delete(): static
    {
        $this->repository->delete();

        return $this;
    }
}
