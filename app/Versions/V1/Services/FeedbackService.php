<?php

namespace App\Versions\V1\Services;

use App\Models\Feedback;
use App\Versions\V1\DTO\FeedbackDto;
use App\Versions\V1\Repositories\FeedbackRepository;

class FeedbackService
{
    private FeedbackRepository $repository;

    public function __construct(
        private Feedback $feedback
    ) {
        $this->repository = app(FeedbackRepository::class, [
            'feedback' => $feedback
        ]);
    }

    public function store(FeedbackDto $dto): Feedback
    {
        $this->repository
            ->fill($dto->toArray())
            ->save();

        return $this->feedback;
    }
}
