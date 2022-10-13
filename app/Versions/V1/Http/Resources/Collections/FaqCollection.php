<?php

namespace App\Versions\V1\Http\Resources\Collections;

use App\Versions\V1\Http\Resources\FaqResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FaqCollection extends ResourceCollection
{
    public $collects = FaqResource::class;
}
