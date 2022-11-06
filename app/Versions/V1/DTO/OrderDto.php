<?php

namespace App\Versions\V1\DTO;

use App\Caster\DatetimeCaster;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class OrderDto extends DataTransferObject
{
    public int $user_id;
    public int $offer_id;
    #[CastWith(DatetimeCaster::class)]
    public ?string $started_at;
    #[CastWith(DatetimeCaster::class)]
    public ?string $finished_at;
    public string $status;

    public static function fromRequest(Request $request): self
    {
        return new self($request->validated() + [
            'user_id' => $request->user()->id
        ]);
    }
}
