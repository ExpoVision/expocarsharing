<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    public const STATUS_AVAILABLE = 'AVAILABLE';
    public const STATUS_RESERVED = 'RESERVED';
    public const STATUS_UNAVAILABLE = 'UNAVAILABLE';
    public const STATUS_BROKEN = 'BROKEN';
    public const STATUS_ERROR = 'ERROR';

    public static array $statuses = [
        self::STATUS_AVAILABLE => 'доступные для аренда',
        self::STATUS_RESERVED => 'забронировано для аренды',
        self::STATUS_UNAVAILABLE => 'в аренде',
        self::STATUS_BROKEN => 'сломано',
        self::STATUS_ERROR => '¯\_(ツ)_/¯',
    ];
}
