<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiningTableFactory extends Factory
{
    public function definition(): array
    {
        return [
            'table_number' => fake()->unique()->numberBetween(1, 100),
            'capacity' => fake()->numberBetween(2, 12),
            'status' => fake()->randomElement(['available', 'occupied', 'reserved']),
        ];
    }
}