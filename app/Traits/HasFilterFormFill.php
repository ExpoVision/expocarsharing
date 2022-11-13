<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasFilterFormFill
{
    public function getAllToFilter(): array
    {
        /** @var Builder $builder */
        $builder = $this->getQuery();

        return $builder->pluck('name', 'id')->toArray();
    }
}
