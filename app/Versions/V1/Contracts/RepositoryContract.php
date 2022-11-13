<?php

namespace App\Versions\V1\Contracts;

use Illuminate\Database\Eloquent\Builder;

abstract class RepositoryContract
{
    public abstract function getQuery(): Builder;
}
