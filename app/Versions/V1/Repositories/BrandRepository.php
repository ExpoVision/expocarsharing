<?php

namespace App\Versions\V1\Repositories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder;

class BrandRepository
{
    public function __construct(
        public Builder $builder
    ) {
        $this->builder = app(Brand::class);
    }

    public function getAllToFilter(): array
    {
        return $this->builder->pluck('name', 'id')->toArray();
    }
}
