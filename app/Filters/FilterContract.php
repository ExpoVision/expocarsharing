<?php

namespace App\Filters;

interface FilterContract
{
    public function handle(string $value): void;
}
