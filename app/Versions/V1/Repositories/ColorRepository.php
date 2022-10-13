<?php

namespace App\Versions\V1\Repositories;

use App\Models\Color;
use App\Traits\HasFilterFormFill;
use App\Versions\V1\Contracts\RepositoryContract;

class ColorRepository extends RepositoryContract
{
    use HasFilterFormFill;

    public const MODEL = Color::class;
}
