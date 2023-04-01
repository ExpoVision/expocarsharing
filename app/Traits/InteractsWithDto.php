<?php

namespace App\Traits;

trait InteractsWithDto
{
    public function onlyFilled(): array
    {
        $array = $this->toArray();
        $data = [];

        foreach ($array as $key => $val) {
            if ($val) $data[$key] = $val;
        }

        return $data;
    }

    public function onlyString(): array
    {
        $array = $this->toArray();
        $data = [];

        foreach ($array as $key => $val) {
            if ($val) {
                if (is_string($val)) {
                    $data[$key] = $val;
                }
            }
        }

        return $data;
    }
}
