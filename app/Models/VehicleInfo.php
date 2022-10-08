<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleInfo extends Model
{
    use HasFactory;

    public const UNIT_KM = 'km';
    public const UNIT_MILE = 'mile';
    public const UNIT_FT = 'ft';

    public const TRANSMISSION_AUTO = 'auto';
    public const TRANSMISSION_MANUAL = 'manual';
    public const TRANSMISSION_CVT = 'cvt';

    public static array $units = [
        self::UNIT_KM => 'км',
        self::UNIT_MILE => 'миль',
        self::UNIT_FT => 'футов',
    ];

    public static array $transmissions = [
        self::TRANSMISSION_AUTO => 'автоматическая',
        self::TRANSMISSION_MANUAL => 'ручная',
        self::TRANSMISSION_CVT => 'CVT',
    ];
}
