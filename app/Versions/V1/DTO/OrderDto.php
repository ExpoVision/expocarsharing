<?php

namespace App\Versions\V1\DTO;

use App\Caster\DatetimeCaster;
use App\Caster\RequestModelBindIdCaster;
use App\Models\Offer;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\DataTransferObject;

class OrderDto extends DataTransferObject
{
    public ?string $username;
    public ?string $address;
    #[CastWith(RequestModelBindIdCaster::class)]
    public int|User $user_id;
    #[CastWith(RequestModelBindIdCaster::class)]
    public int|Offer $offer_id;
    #[CastWith(DatetimeCaster::class)]
    public ?Carbon $started_at;
    #[CastWith(DatetimeCaster::class)]
    public ?Carbon $finished_at;
    public ?CarbonInterval $active_in;
    public string $status;

    public static function fromRequest(Request $request): self
    {
        return new self($request->all() + [
            'user_id' => $request->user()->id,
            'offer_id' => $request->route('offer'),
            'status' => Order::STATUS_RESERVED,
        ]);
    }
}
