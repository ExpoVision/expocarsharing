<?php

namespace App\Models;

use App\Traits\HasVehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleInfo extends Model
{
    use HasFactory;
    use HasVehicle;

    // FIXME: Refactor to enums
    public const UNIT_KM   = 'KM';
    public const UNIT_MILE = 'MILE';
    public const UNIT_FT   = 'FT';

    public const TRANSMISSION_AUTO   = 'AUTO';
    public const TRANSMISSION_MANUAL = 'MANUAL';
    public const TRANSMISSION_CVT    = 'CVT';

    public static array $units = [
        self::UNIT_KM   => 'км',
        self::UNIT_MILE => 'миль',
        self::UNIT_FT   => 'футов',
    ];

    public static array $transmissions = [
        self::TRANSMISSION_AUTO   => 'автоматическая',
        self::TRANSMISSION_MANUAL => 'ручная',
        self::TRANSMISSION_CVT    => 'CVT',
    ];

    protected $fillable = [
        'power_reserve_unit',
        'power_reserve',
        'transmission',
        'body_type_id',
        'consumption',
        'vehicle_id',
        'horsepower',
        'multimedia',
        'seats',
    ];

    protected $casts = [
        'multimedia' => 'boolean',
    ];

    public function bodyType(): BelongsTo
    {
        return $this->belongsTo(BodyType::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
