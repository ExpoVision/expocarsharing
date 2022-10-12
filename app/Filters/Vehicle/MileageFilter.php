<?php

namespace App\Filters\Vehicle;

use App\Filters\FilterContract;

class MileageFilter extends FilterContract
{
    public function handle(string|array $value): void
    {
        $this->query->where('mileage', '<=', $value);
    }
}
