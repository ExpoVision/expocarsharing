<?php

namespace App\Versions\V1\Services;

use App\Models\Review;
use App\Versions\V1\DTO\ReviewDto;
use App\Versions\V1\Repositories\ReviewRepository;

class ReviewService
{
    private ReviewRepository $repository;

    public function __construct(
        private Review $review
    ) {
        $this->repository = app(ReviewRepository::class, compact('review'));
    }

    public function store(ReviewDto $dto): Review
    {
        $this->repository->fill($dto)
            ->save();

        return $this->review;
    }
}
