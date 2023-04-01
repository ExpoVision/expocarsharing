<?php

namespace App\Versions\V1\DTO;

use App\Caster\RequestModelBindIdCaster;
use App\Traits\InteractsWithDto;
use App\Versions\V1\Http\Requests\UserPayCardStoreRequest;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class UserPayDto extends DataTransferObject
{
    use InteractsWithDto;

    public string $card_number;
    public int $expdate_year;
    public int $expdate_month;
    public int $cvv;
    public string $holder_name;
    public string $holder_surname;
    #[CastWith(RequestModelBindIdCaster::class)]
    public int $user_id;

    public static function fromRequest(UserPayCardStoreRequest $request): static
    {
        return new self($request->validated());
    }
}
