<?php

namespace App\Versions\V1\DTO;

use App\Caster\DatetimeCaster;
use App\Caster\RequestModelBindIdCaster;
use App\Traits\InteractsWithDto;
use App\Versions\V1\Http\Requests\UserProfileStoreRequest;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class UserProfileDto extends DataTransferObject
{
    use InteractsWithDto;

    #[CastWith(DatetimeCaster::class)]
    public ?Carbon $birthday;
    public ?string $phone;
    public ?UploadedFile $photo;
    public ?UploadedFile $passport;
    public ?UploadedFile $license;
    #[CastWith(RequestModelBindIdCaster::class)]
    public int $user_id;

    public static function fromRequest(UserProfileStoreRequest $request): static
    {
        return new self($request->validated());
    }
}
