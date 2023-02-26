<?php

namespace App\Versions\V1\Repositories;

use App\Models\Review;
use App\Versions\V1\Contracts\RepositoryContract;
use App\Versions\V1\DTO\ReviewDto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ReviewRepository extends RepositoryContract
{
    public function __construct(
        private Review $review
    ) {
    }

    public function getQuery(): Builder
    {
        return $this->review->newQuery();
    }

    public function paginate(?int $perGroup = 5): LengthAwarePaginator
    {
        return $this->getQuery()->paginate($perGroup);
    }

    public function fill(ReviewDto $review): static
    {
        $this->review->fill($review->toArray());

        return $this;
    }

    public function save(): static
    {
        $this->review->save();

        return $this;
    }
}
