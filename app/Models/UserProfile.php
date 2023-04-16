<?php

namespace App\Models;

use App\MediaSaver\UserProfileMediaManager;
use App\Versions\V1\DTO\UserProfileDto;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Carbon $birthday
 * @property string $phone
 * @property string $photo
 * @property string $passport
 * @property string $license
 * @property-read int $user_id
 */
class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'birthday',
        'passport',
        'license',
        'user_id',
        'photo',
        'phone',
    ];

    public const MEDIA_FIELDS = ['photo', 'license', 'passport'];

    public function addMediaFromRequest(UserProfileDto $dto): void
    {
        array_map(
            function ($key) use ($dto) {
                if ($dto->$key) {
                    $path = app(
                        UserProfileMediaManager::class,
                        [
                            'model' => $this,
                            'file'  => $dto->$key,
                            'key'   => $key,
                        ],
                    )->save();

                    $this->$key = $path;
                    $this->save();
                }
            },
            self::MEDIA_FIELDS,
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
