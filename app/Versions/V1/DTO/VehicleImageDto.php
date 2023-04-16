<?php

namespace App\Versions\V1\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class VehicleImageDto extends DataTransferObject
{
    public string $path;
    public int $vehicle_id;
}
