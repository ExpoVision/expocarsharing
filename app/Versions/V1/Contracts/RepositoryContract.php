<?php

namespace App\Versions\V1\Contracts;

abstract class RepositoryContract
{
    /**
     * @return Illuminate\Database\Eloquent\Builder|QueryBuiIlluminate\Database\Query\Builder
     */
    public abstract function getQuery();
}
