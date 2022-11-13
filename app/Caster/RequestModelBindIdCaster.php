<?php

namespace App\Caster;

use Illuminate\Database\Eloquent\Model;
use Spatie\DataTransferObject\Caster;

class RequestModelBindIdCaster implements Caster
{
    public function cast(mixed $value): mixed
    {
        if ($value instanceof Model) {
            return $value->id;
        }

        return $value;
    }
}
