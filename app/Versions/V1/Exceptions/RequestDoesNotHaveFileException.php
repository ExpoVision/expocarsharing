<?php

namespace App\Versions\V1\Exceptions;

use Exception;

class RequestDoesNotHaveFileException extends Exception
{
    public static function create(string $key): self
    {
        return new static(__('validation.request_file', compact('key')));
    }
}
