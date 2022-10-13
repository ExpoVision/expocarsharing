<?php

namespace App\Versions\V1\Repositories;

use App\Models\Color;
use App\Traits\HasFilterFormFill;
use Illuminate\Database\Eloquent\Builder;

class ColorRepository
{
    use HasFilterFormFill;

    public function __construct(
        public Builder $builder
    ) {
        $this->builder = app(Color::class)->query();
    }
}
