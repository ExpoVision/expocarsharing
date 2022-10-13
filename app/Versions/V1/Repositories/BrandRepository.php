<?php

namespace App\Versions\V1\Repositories;

use App\Models\Brand;
use App\Traits\HasFilterFormFill;
use App\Versions\V1\Contracts\RepositoryContract;

class BrandRepository extends RepositoryContract
{
    use HasFilterFormFill;

    public const MODEL = Brand::class;
}
