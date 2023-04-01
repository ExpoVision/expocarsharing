<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property int $card_number
 * @property int $expdate_year
 * @property int $expdate_month
 * @property int $cvv
 * @property string $holder_name
 * @property string $holder_surname
 * @property User $user
 */
class UserPay extends Model
{
    use HasFactory;

    protected $fillable = [
        'holder_surname',
        'expdate_month',
        'expdate_year',
        'card_number',
        'holder_name',
        'user_id',
        'cvv',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
