<?php

namespace App\Traits;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasVehicle
{
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
