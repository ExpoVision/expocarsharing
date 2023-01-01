<?php

namespace App\Versions\V1\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class FeedbackDto extends DataTransferObject
{
    public string $fullname;
    public string $phone;

    /**
     * @param Request $request
     *
     * @return self
     */
    public static function fromRequest(Request $request): self
    {
        return new self($request->all());
    }
}
