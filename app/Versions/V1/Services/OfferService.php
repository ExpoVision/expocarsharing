<?php

namespace App\Versions\V1\Services;

use App\Models\Offer;
use App\Versions\V1\DTO\OfferDto;
use App\Versions\V1\Repositories\OfferRepository;

class OfferService
{
    private OfferRepository $repository;

    public function __construct(
        private Offer $offer
    ) {
        $this->repository = app(OfferRepository::class, compact('offer'));
    }

    public function store(OfferDto $dto): static
    {
        $this->repository
            ->fill($dto->toArray())
            ->save();

        return $this;
    }
}
