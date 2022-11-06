<?php

namespace App\Caster;

use Carbon\Carbon;
use Spatie\DataTransferObject\Caster;

class DatetimeCaster implements Caster
{
    public function cast(mixed $value): Carbon
    {
        return Carbon::make($value);
    }
}
