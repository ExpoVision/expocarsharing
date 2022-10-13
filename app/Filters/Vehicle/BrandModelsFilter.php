<?php

namespace App\Filters\Vehicle;

use App\Filters\FilterContract;
use Illuminate\Database\Eloquent\Builder;

class BrandModelsFilter extends FilterContract
{
    public function handle(string|array $value): void
    {
        $this->query->whereHas('brandModel', function (Builder $query) use ($value) {
            $query->whereIn('id', $value);
        });
    }
}
