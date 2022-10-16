<?php

namespace App\Versions\V1\Services;

use App\Models\Order;

class PriceService
{
    public function orderActivePrice(Order $order): float
    {
        $totalHours = $order->active_in->totalHours;
        $per_minute = $order->offer->per_minute;

        return $this->calculate($totalHours, $per_minute);
    }

    public function orderFinishPrice(Order $order): float
    {
        $totalHours = $order->finished_at->diffAsCarbonInterval(now())->totalHours;
        $per_minute = $order->offer->per_minute;

        return $this->calculate($totalHours, $per_minute);
    }

    private function calculate(float $totalHours, float $perMinute): float
    {
        return round($totalHours * $perMinute, 2);
    }
}
