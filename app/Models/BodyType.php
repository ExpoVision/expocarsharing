<?php

namespace App\Models;

use App\Traits\HasVehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class BodyType extends Model
{
    use HasFactory;
    use HasVehicle;

    protected $fillable = ['name'];

    public function vahicleInfos(): HasMany
    {
        return $this->hasMany(VehicleInfo::class);
    }

    public function vehicles(): HasManyThrough
    {
        return $this->hasManyThrough(Vehicle::class, VehicleInfo::class);
    }
}
