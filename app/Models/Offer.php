<?php

namespace App\Models;

use App\Scopes\WithVehicleScope;
use App\Traits\HasFilter;
use App\Traits\HasVehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property float $per_minute
 * @property string $status
 * @property-read int $vehicle_id
 * @property-read \App\Models\Vehicle $vehicle
 * @property-read \App\Models\Order $order
 * @property-read \Carbon\Carbon|null $created_at
 * @property-read \Carbon\Carbon|null $updated_at
 * @property-read \Carbon\Carbon|null $deleted_at
 * @method \Illuminate\Database\Eloquent\Builder filterBy(array $filters)
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Offer extends Model
{
    use HasFactory;
    use HasVehicle;
    use SoftDeletes;
    use HasFilter;

    public const FILTER_FOLDER = 'Offer';

    public const STATUS_AVAILABLE   = 'AVAILABLE';
    public const STATUS_UNAVAILABLE = 'UNAVAILABLE';

    public static array $statuses = [
        self::STATUS_AVAILABLE   => 'доступно для аренды',
        self::STATUS_UNAVAILABLE => 'активная аренда',
    ];

    protected $fillable = ['per_minute'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new WithVehicleScope);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
