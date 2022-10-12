<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Brand;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BrandModel>
 */
class BrandModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $brand_id = Brand::inRandomOrder()->first()->id;

        return [
            'name' => $this->faker->unique()->word,
            'brand_id' => $brand_id,
        ];
    }
}
