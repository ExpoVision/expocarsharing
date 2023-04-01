<?php

namespace App\Versions\V1\Services;

use App\Models\UserProfile;
use App\Versions\V1\DTO\UserProfileDto;
use App\Versions\V1\Repositories\UserProfileRepository;

class UserProfileService
{
    public function __construct(
        private UserProfile $userProfile,
        private UserProfileRepository $repository,
    ) {
        $this->repository = app(UserProfileRepository::class, compact('userProfile'));
    }

    public function store(UserProfileDto $dto): static
    {
        $this->repository
            ->updateOrCreate($dto)
            ->saveMedia($dto);

        return $this;
    }
}
