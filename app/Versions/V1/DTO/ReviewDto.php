<?php

namespace App\Versions\V1\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use App\Versions\V1\Http\Requests\ReviewStoreRequest;

class ReviewDto extends DataTransferObject
{
    public string $name;
    public string $review;
    public ?string $title;
    public int $evaluation;

    /**
     * @param ReviewStoreRequest $request
     *
     * @return static
     */
    public static function fromRequest($request)
    {
        return new self($request->validated());
    }
}
