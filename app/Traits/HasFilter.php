<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Filters\FilterBuilder;

trait HasFilter
{
    public function scopeFilterBy(Builder $query, array $filters): Builder
    {
        $folder = static::FILTER_FOLDER;

        $filter = new FilterBuilder($query, $filters, $folder);

        return $filter->apply();
    }
}
