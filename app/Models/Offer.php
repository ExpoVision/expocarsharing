<?php

namespace App\Models;

use App\Traits\HasVehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory;
    use HasVehicle;
    use SoftDeletes;

    public const STATUS_AVAILABLE   = 'AVAILABLE';
    public const STATUS_UNAVAILABLE = 'UNAVAILABLE';

    public static array $statuses = [
        self::STATUS_AVAILABLE   => 'доступно для аренды',
        self::STATUS_UNAVAILABLE => 'активная аренда',
    ];

    protected $fillable = ['per_minute'];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
