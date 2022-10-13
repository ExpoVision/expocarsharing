<?php

namespace App\Versions\V1\Http\Resources\Collections;

use App\Versions\V1\Http\Resources\FeedbackResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FeedbackCollection extends ResourceCollection
{
    public $collects = FeedbackResource::class;
}
