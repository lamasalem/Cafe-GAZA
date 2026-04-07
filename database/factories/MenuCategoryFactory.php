<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Hot Drinks', 'Cold Drinks', 'Sandwiches', 'Desserts',
                'Salads', 'Main Courses', 'Appetizers', 'Soups',
                'Breakfast', 'Pasta', 'Pizza', 'Grills',
                'Juices', 'Smoothies', 'Cakes', 'Ice Cream',
                'Seafood', 'Burgers', 'Wraps', 'Sides'
            ]),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}