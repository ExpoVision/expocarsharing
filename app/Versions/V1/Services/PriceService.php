<?php

namespace App\Versions\V1\Services;

use App\Versions\V1\DTO\OfferDto;
use App\Versions\V1\DTO\OrderDto;

class PriceService
{
    public function orderActivePrice(OrderDto $order, OfferDto $offer): float
    {
        $totalHours = $order->active_in->totalMinutes;
        $per_minute = $offer->per_minute;

        return $this->calculate($totalHours, $per_minute);
    }

    public function orderFinishPrice(OrderDto $order, OfferDto $offer): float
    {
        $totalHours = $order->finished_at->diffAsCarbonInterval($order->started_at)->totalMinutes;
        $per_minute = $offer->per_minute;

        return $this->calculate($totalHours, $per_minute);
    }

    private function calculate(float $totalMinutes, float $perMinute): float
    {
        return round($totalMinutes * $perMinute, 2);
    }
}
