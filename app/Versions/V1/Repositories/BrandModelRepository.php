<?php

namespace App\Versions\V1\Repositories;

use App\Models\BrandModel;
use App\Traits\HasFilterFormFill;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Builder;

class BrandModelRepository extends RepositoryContract
{
    use HasFilterFormFill;

    public const MODEL = BrandModel::class;
}
