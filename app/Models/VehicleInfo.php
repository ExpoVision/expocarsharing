<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleInfo extends Model
{
    use HasFactory;

    public const UNIT_KM = 'KM';
    public const UNIT_MILE = 'MILE';
    public const UNIT_FT = 'FT';

    public const TRANSMISSION_AUTO = 'AUTO';
    public const TRANSMISSION_MANUAL = 'MANUAL';
    public const TRANSMISSION_CVT = 'CVT';

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
