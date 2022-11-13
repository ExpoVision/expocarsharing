<?php

namespace App\Versions\V1\Repositories;

use App\Models\Brand;
use App\Traits\HasFilterFormFill;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;

class BrandRepository extends RepositoryContract
{
    use HasFilterFormFill;

    public function __construct(
        private Brand $brand
    ) {
    }

    public function getQuery(): Builder
    {
        return $this->brand->newQuery();
    }
}
