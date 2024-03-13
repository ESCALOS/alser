<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'purchase' => $this->faker->randomFloat(4, 3.4, 3.9),
            'sales' => $this->faker->randomFloat(4, 3.4, 3.9),
        ];
    }
}
