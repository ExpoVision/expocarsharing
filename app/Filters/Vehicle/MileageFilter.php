<?php

namespace App\Filters\Vehicle;

use App\Filters\FilterContract;
use Illuminate\Database\Eloquent\Builder;

class MileageFilter implements FilterContract
{
    protected Builder $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function handle(string $value): void
    {
        $this->query->where('mileage', '<=', $value);
    }
}
