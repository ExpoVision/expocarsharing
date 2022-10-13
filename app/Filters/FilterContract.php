<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class FilterContract
{
    protected Builder $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public abstract function handle(string|array $value): void;
}
