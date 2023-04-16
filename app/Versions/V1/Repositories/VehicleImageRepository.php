<?php

namespace App\Versions\V1\Repositories;

use App\Models\VehicleImage;
use App\Versions\V1\Contracts\RepositoryContract;

class VehicleImageRepository extends RepositoryContract
{

    public function __construct(
        private VehicleImage $image,
    ) {
    }

    public function getQuery()
    {
        return $this->image->getQuery();
    }

    public function fill(array $data): static
    {
        $this->image->fill($data);

        return $this;
    }

    public function save(): static
    {
        $this->image->save();

        return $this;
    }
}
