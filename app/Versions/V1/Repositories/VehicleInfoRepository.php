<?php

namespace App\Versions\V1\Repositories;

use App\Models\Vehicle;
use App\Models\VehicleInfo;
use App\Versions\V1\Contracts\RepositoryContract;

class VehicleInfoRepository extends RepositoryContract
{
    private VehicleInfo $info;

    public function __construct(
        private Vehicle $vehicle,
    ) {
        $this->info = $vehicle->info
            ?: app(VehicleInfo::class)
            ->fill(['vehicle_id' => $vehicle->id]);
    }

    public function foo()
    {
        return $this->info;
    }

    public function bar()
    {
        return $this->vehicle;
    }

    public function getQuery()
    {
        return $this->vehicle->info()->getQuery();
    }

    public function fill(array $data): static
    {
        $this->info->fill($data);

        return $this;
    }

    public function save(): static
    {
        $this->info->save();

        return $this;
    }
}
