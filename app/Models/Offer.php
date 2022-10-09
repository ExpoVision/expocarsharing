<?php

namespace App\Models;

use App\Traits\HasVehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;
    use HasVehicle;

    // FIXME: Refactor to enums
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

    protected $fillable = [
        'per_minute',
        'status',
    ];

    protected $casts = [
        'started_at' => 'datetime',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
