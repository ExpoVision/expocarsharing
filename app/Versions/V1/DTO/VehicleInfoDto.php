<?php

namespace App\Versions\V1\DTO;

use App\Versions\V1\Http\Requests\VehicleStoreRequest;
use Spatie\DataTransferObject\DataTransferObject;

class VehicleInfoDto extends DataTransferObject
{
    public int $body_type_id;
    public float $power_reserve;
    public string $power_reserve_unit;
    public float $consumption;
    public float $horsepower;
    public string $transmission;
    public bool $multimedia;
    public int $seats;

    public static function fromRequest(VehicleStoreRequest $request): static
    {
        $validated = $request->validated();
        $info = isset($validated['vehicle_info']) ? $validated['vehicle_info'] : $validated;

        return new self($info);
    }
}
