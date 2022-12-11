<?php

namespace App\Models;

use App\Traits\HasVehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class VehicleClass extends Model
{
    use HasFactory;
    use HasVehicle;

    protected $fillable = ['name'];

    const PER_GROUP = 5;

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function offers(): HasManyThrough
    {
        return $this->hasManyThrough(Offer::class, Vehicle::class);
    }
}
