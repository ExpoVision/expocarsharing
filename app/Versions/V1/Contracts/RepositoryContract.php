<?php

namespace App\Versions\V1\Contracts;

use Illuminate\Database\Eloquent\Builder;

abstract class RepositoryContract
{
    public function __construct(
        public Builder $builder
    ) {
        /**
         * like `public const MODEL` in successor class
         * 
         * @var string $modelClass 
        */
        $modelClass = static::MODEL;

        $this->builder = app($modelClass)->query();
    }
}
