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
        private Vehicle $vehicle
    ) {
    }

    public function getQuery(): Builder
    {
        return $this->vehicle->newQuery();
    }

    public function getQueryWithInfo(): Builder
    {
        return $this->getQuery()->with(['brand', 'brandModel', 'color', 'class']);
    }

    /**
     * @param int|null $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return $this->getQuery()->paginate($perPage);
    }

    public function getById(int $id): Vehicle
    {
        return $this->getQueryWithInfo()->findOrFail($id);
    }

    public function groupedByClass(?int $perGroup = null): Collection
    {
        return $this->classRepository->certainWithVehicles($perGroup);
    }
}
