<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Hot drink',
                'Cold drink',
                'Dessert',
                'Sandwiches',
            ]),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}