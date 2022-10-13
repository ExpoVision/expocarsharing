<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $vehicleIds = Vehicle::all()->pluck('id')->toArray();

        return [
            'vehicle_id' => $this->faker->unique()->randomElement($vehicleIds),
            'per_minute' => $this->faker->numberBetween(15, 500),
            'status' => Offer::STATUS_AVAILABLE,
        ];
    }
}
