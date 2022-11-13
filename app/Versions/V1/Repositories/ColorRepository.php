<?php

namespace App\Versions\V1\Repositories;

use App\Models\Color;
use App\Traits\HasFilterFormFill;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;

class ColorRepository extends RepositoryContract
{
    use HasFilterFormFill;

    public function __construct(
        private Color $color
    ) {
    }

    public function getQuery(): Builder
    {
        return $this->color->newQuery();
    }
}
