<?php

namespace App\Versions\V1\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Vehicle;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;

class VehicleRepository extends RepositoryContract
{
    public function __construct(
        private Vehicle $vehicle,
    ) {
    }

    public function getQuery(): Builder
    {
        return $this->vehicle->newQuery();
    }

    public function getQueryWithBaseRelations(): Builder
    {
        return $this->getQuery()->with(['brand', 'brandModel', 'color', 'class']);
    }

    public function getQueryWithFullInfo(): Builder
    {
        return $this->getQueryWithBaseRelations()->with('info');
    }

    /**
     * @param int|null $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(?int $perPage = null): LengthAwarePaginator
    {
        return $this->getQueryWithBaseRelations()->paginate($perPage);
    }

    public function find(int $id): Vehicle
    {
        return $this->getQueryWithFullInfo()->findOrFail($id);
    }

    public function delete(): static
    {
        $this->vehicle->delete();

        return $this;
    }
}
