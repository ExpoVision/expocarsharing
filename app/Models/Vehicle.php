<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $brand_id
 * @property int $brand_model_id
 * @property int $color_id
 * @property int $vehicle_info_id
 * @property string $license_plate
 * @property int $vehicle_class_id
 * @property float $mileage
 * @property int $year
 * @property \App\Models\Brand $brand
 * @property \App\Models\Color $color
 * @property \App\Models\BrandModel $brandModel
 * @property \App\Models\VehicleInfo $info
 * @property \App\Models\Offer $offer
 * @property \App\Models\VehicleClass $class
 * @property-read \Carbon\Carbon|null $created_at
 * @property-read \Carbon\Carbon|null $updated_at
 * @property-read \Carbon\Carbon|null $deleted_at
 */
class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

    public const FILTER_FOLDER = 'Vehicle';

    protected $fillable = [
        'brand_id',
        'brand_model_id',
        'vehicle_class_id',
        'license_plate',
        'color_id',
        'vehicle_info_id',
        'mileage',
        'year',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function brandModel(): BelongsTo
    {
        return $this->belongsTo(BrandModel::class);
    }

    public function info(): HasOne
    {
        return $this->hasOne(VehicleInfo::class);
    }

    public function offer(): HasOne
    {
        return $this->hasOne(Offer::class);
    }

    public function class(): BelongsTo
    {
        return $this->belongsTo(VehicleClass::class, 'vehicle_class_id', 'id');
    }
}
