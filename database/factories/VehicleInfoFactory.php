<?php

namespace Database\Factories;

use App\Models\BodyType;
use App\Models\Vehicle;
use App\Models\VehicleInfo;
use Illuminate\Database\Eloquent\Factories\Factory;
use OverflowException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleInfo>
 */
class VehicleInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'body_type_id' => BodyType::factory()->create()->id,
            'vehicle_id' => Vehicle::factory()->create()->id,
            'power_reserve' => $this->faker->numberBetween(200, 1810),
            'power_reserve_unit' => $this->faker->randomElement(array_keys(VehicleInfo::$units)),
            'consumption' => $this->faker->randomFloat(1, 0, 30),
            'horsepower' => $this->faker->numberBetween(100, 800),
            'transmission' => $this->faker->randomElement(array_keys(VehicleInfo::$transmissions)),
            'multimedia' => $this->faker->boolean(),
            'seats' => $this->faker->randomElement([2, 4]),
        ];
    }
}
