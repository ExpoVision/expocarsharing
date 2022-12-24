<?php

namespace App\Versions\V1\Http\Resources\Collections;

use App\Versions\V1\Http\Resources\ReviewResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReviewCollection extends ResourceCollection
{
    public $collects = ReviewResource::class;

    public function with($request)
    {
        $next = $this->currentPage() + 1;

        if ($next > $this->lastPage()) {
            $next = null;
        }

        return [
            'meta' => compact('next'),
        ];
    }
}
