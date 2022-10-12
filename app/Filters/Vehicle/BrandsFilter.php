<?php

namespace App\Filters\Vehicle;

use App\Filters\FilterContract;
use Illuminate\Database\Eloquent\Builder;

class BrandsFilter extends FilterContract
{
    public function handle(string|array $value): void
    {
        $this->query->whereHas('brand', function (Builder $query) use ($value) {
            $query->whereIn('name', $value);
        });
    }
}
