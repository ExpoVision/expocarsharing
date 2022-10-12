<?php

namespace App\Versions\V1\Http\Resources\Collections;

use App\Versions\V1\Http\Resources\VehicleClassResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VehicleClassCollection extends ResourceCollection
{
    public $collects = VehicleClassResource::class;
}
