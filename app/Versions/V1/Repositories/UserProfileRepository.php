<?php

namespace App\Versions\V1\Repositories;

use App\Models\UserProfile;
use App\Versions\V1\Contracts\RepositoryContract;
use App\Versions\V1\DTO\UserProfileDto;
use Illuminate\Database\Eloquent\Builder;

class UserProfileRepository extends RepositoryContract
{
    const MEDIA_COLUMNS = ['photo', 'license', 'passport'];

    public function __construct(
        private UserProfile $userProfile
    ) {
    }

    public function getQuery(): Builder
    {
        return $this->userProfile->newQuery();
    }

    public function updateOrCreate(UserProfileDto $dto): static
    {
        $this->userProfile = $this->userProfile->updateOrCreate(
            ['user_id' => $dto->user_id],
            $dto->withoutFiles(),
        );

        return $this;
    }

    public function fill(UserProfileDto $dto): static
    {
        $this->userProfile->fill($dto->onlyFilled());

        return $this;
    }

    public function save(): static
    {
        $this->userProfile->save();

        return $this;
    }

    public function saveMedia(UserProfileDto $dto): static
    {
        $this->userProfile->addMediaFromRequest($dto);

        return $this;
    }
}
