<?php

namespace App\Versions\V1\DTO;

use App\Versions\V1\Http\Requests\VehicleStoreRequest;
use Illuminate\Http\UploadedFile;
use Spatie\DataTransferObject\DataTransferObject;

class VehicleDto extends DataTransferObject
{
    public ?int $id;
    public int $brand_id;
    public int $brand_model_id;
    public int $color_id;
    public int $vehicle_class_id;
    public float $mileage;
    public int $year;
    public string $license_plate;
    /**
     * @var array<UploadedFile>
     */
    public ?array $images;

    public static function fromRequest(VehicleStoreRequest $request): static
    {
        $validated = $request->validated();
        $vehicle = isset($validated['vehicle']) ? $validated['vehicle'] : $validated;

        return new self($vehicle);
    }
}
