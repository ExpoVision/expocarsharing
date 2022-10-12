<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory;
    use HasFilter;
    use SoftDeletes;

    public const FILTER_FOLDER = 'Vehicle';

    protected $fillable = [
        'brand_id',
        'model_id',
        'color_id',
        'vehicle_info_id',
        'mileage',
        'year',
    ];

    public function bodyType(): BelongsTo
    {
        return $this->belongsTo(BodyType::class);
    }

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
}
