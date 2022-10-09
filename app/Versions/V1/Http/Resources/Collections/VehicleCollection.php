<?php

namespace App\Versions\V1\Http\Resources\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Versions\V1\Http\Resources\VehicleResource;

class VehicleCollection extends ResourceCollection
{
    public $collects = VehicleResource::class;
}
