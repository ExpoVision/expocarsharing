<?php

namespace App\Versions\V1\Repositories;

use App\Models\BrandModel;
use App\Traits\HasFilterFormFill;
use Illuminate\Database\Eloquent\Builder;

class BrandModelRepository
{
    use HasFilterFormFill;

    public function __construct(
        public Builder $builder
    ) {
        $this->builder = app(BrandModel::class)->query();
    }
}
