<?php

namespace App\Versions\V1\DTO;

use App\Models\Offer;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class OfferDto extends DataTransferObject
{
    public int $vehicle_id;
    public float $per_minute;
    public string $status;

    /**
     * @todo create action requests
     */
    public static function fromRequest(Request $request): static
    {
        return new self($request->all() + ['status' => Offer::STATUS_AVAILABLE]);
    }

    public static function fromVehicleWithAttrs(int $vehicle_id, array $attrs): static
    {
        $attrs['status'] = Offer::STATUS_AVAILABLE;

        return new self($attrs + compact('vehicle_id'));
    }
}
