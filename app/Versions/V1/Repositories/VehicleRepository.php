<?php

namespace App\Versions\V1\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Vehicle;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class VehicleRepository extends RepositoryContract
{
    public function __construct(
        public Builder $builder,
        public VehicleClassRepository $classRepository,
    ) {
        $this->builder = app(Vehicle::class)->with(['brand', 'brandModel', 'color', 'class']);
    }

    /**
     * @param int|null $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return $this->builder->paginate($perPage);
    }

    public function groupedByClass(?int $perGroup = null): Collection
    {
        return $this->classRepository->certainWithVehicles($perGroup);
    }
}
