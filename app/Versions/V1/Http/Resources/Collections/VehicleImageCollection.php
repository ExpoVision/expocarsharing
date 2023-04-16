<?php

namespace App\Versions\V1\Http\Resources\Collections;

use App\Versions\V1\Http\Resources\VehicleImageResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VehicleImageCollection extends ResourceCollection
{
    public $collects = VehicleImageResource::class;
}
