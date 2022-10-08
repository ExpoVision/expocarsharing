<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    public const STATUS_AVAILABLE = 'available';
    public const STATUS_RESERVED = 'reserved';
    public const STATUS_UNAVAILABLE = 'unavailable';
    public const STATUS_BROKEN = 'broken';
    public const STATUS_ERROR = 'error';

    public static array $statuses = [
        self::STATUS_AVAILABLE => 'доступные для аренда',
        self::STATUS_RESERVED => 'забронировано для аренды',
        self::STATUS_UNAVAILABLE => 'в аренде',
        self::STATUS_BROKEN => 'сломано',
        self::STATUS_ERROR => '¯\_(ツ)_/¯',
    ];
}
