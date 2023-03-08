<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\BrandModel;
use App\Models\Color;
use App\Models\VehicleClass;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use OverflowException;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'brand_id' => Brand::factory()->create()->id,
            'brand_model_id' => BrandModel::factory()->create()->id,
            'color_id' => Color::factory()->create()->id,
            'vehicle_class_id' => VehicleClass::factory()->create()->id,
            'mileage' => $this->faker->randomFloat(2),
            'year' => $this->faker->numberBetween(1990, 2020),
            'license_plate' => ''
            . Str::upper($this->faker->lexify('?'))
            . $this->faker->unique()->numerify('###')
            . Str::upper($this->faker->lexify('??')),
        ];
    }
}
