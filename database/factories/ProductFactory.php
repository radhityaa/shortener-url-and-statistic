<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'          => $name = $this->faker->sentence(),
            'slug'          => str($name)->slug(),
            'description'   => $this->faker->paragraph(),
            'price'         => $this->faker->numberBetween(10000, 100000)
        ];
    }
}
