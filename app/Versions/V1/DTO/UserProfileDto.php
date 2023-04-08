<?php

namespace App\Versions\V1\DTO;

use App\Caster\DatetimeCaster;
use App\Caster\RequestModelBindIdCaster;
use App\Traits\InteractsWithDto;
use App\Versions\V1\Http\Requests\UserProfileUpdateRequest;
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

    /**
     * @param UserProfileUpdateRequest|array $request
     *
     * @return static
     */
    public static function fromRequest($request): static
    {
        $requestData = is_array($request) ? $request : $request->validated();

        return new self($requestData);
    }
}
