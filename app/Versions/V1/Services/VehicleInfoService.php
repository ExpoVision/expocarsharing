<?php

namespace App\Versions\V1\Services;

use App\Models\Vehicle;
use App\Versions\V1\DTO\VehicleInfoDto;
use App\Versions\V1\Repositories\VehicleInfoRepository;

class VehicleInfoService
{
    private VehicleInfoRepository $repository;

    public function __construct(
        private Vehicle $vehicle,
    ) {
        $this->repository = app(VehicleInfoRepository::class, compact('vehicle'));
    }

    public function store(VehicleInfoDto $dto): static
    {
        $this->repository
            ->fill($dto->toArray())
            ->save();

        return $this;
    }
}
