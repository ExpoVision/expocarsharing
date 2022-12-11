<?php

namespace App\Versions\V1\Services;

use App\Models\Vehicle;

class VehicleService
{
    public function __construct(
        private Vehicle $vehicle
    ) {
    }
}
