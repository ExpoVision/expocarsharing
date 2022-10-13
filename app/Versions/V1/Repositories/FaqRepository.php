<?php

namespace App\Versions\V1\Repositories;

use App\Models\Faq;
use App\Versions\V1\Contracts\RepositoryContract;
use Illuminate\Pagination\LengthAwarePaginator;

class FaqRepository extends RepositoryContract
{
    public const MODEL = Faq::class;

    public function paginate(?int $perPage): LengthAwarePaginator
    {
        return $this->builder->paginate($perPage);
    }
}
