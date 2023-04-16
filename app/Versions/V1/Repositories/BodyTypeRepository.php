<?php

namespace App\Versions\V1\Repositories;

use App\Models\BodyType;
use App\Traits\HasFilterFormFill;
use App\Versions\V1\Contracts\RepositoryContract;

class BodyTypeRepository extends RepositoryContract
{
    use HasFilterFormFill;

    public function __construct(
        private BodyType $bodyType
    ) {
    }

    public function getQuery()
    {
        return $this->bodyType->getQuery();
    }
}
