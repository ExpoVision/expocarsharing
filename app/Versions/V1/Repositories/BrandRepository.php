<?php

namespace App\Versions\V1\Repositories;

use App\Models\Brand;

class BrandRepository
{
    public function __construct(
        public Brand $brand
    ) {
    }

    public function find(int $id): Brand
    {
        return $this->brand->findOrFail($id);
    }
}
