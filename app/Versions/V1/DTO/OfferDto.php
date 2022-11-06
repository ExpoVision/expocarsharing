<?php

namespace App\Versions\V1\DTO;

use App\Models\Order;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class OfferDto extends DataTransferObject
{
    public int $offer_id;
    public float $per_minute;
    public string $status;

    /**
     * @todo create action requests
     */
    public static function fromRequest(Request $request): static
    {
        return new self($request->all() + [
            'status' => Order::STATUS_RESERVED
        ]);
    }
}
