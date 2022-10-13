<?php

namespace App\Filters\Offer;

use App\Filters\FilterContract;
use App\Versions\V1\Repositories\OfferRepository;

class PriceFilter extends FilterContract
{
    public function handle(string|array $value): void
    {
        [$from, $to] = explode(',', $value);

        if (!$from || !$to) {
            /** @var OfferRepository $offerRepository */
            $offerRepository = app(OfferRepository::class);

            if (!$from) {
                $from = $offerRepository->getMinPerMinute();
            }

            if (!$to) {
                $to = $offerRepository->getMaxPerMinute();
            }
        }

        $this->query->whereBetween('per_minute', [$from, $to]);
    }
}