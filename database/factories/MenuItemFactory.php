<?php

namespace Database\Factories;

use App\Models\MenuCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'Item_Name' => fake()->randomElement([
               
                 'Hot Drinks', 'Cold Drinks', 'Sandwiches', 'Desserts',
                'Salads', 'Main Courses', 'Appetizers', 'Soups',
                'Breakfast', 'Pasta', 'Pizza', 'Grills',
                'Juices', 'Smoothies', 'Cakes', 'Ice Cream',
                'Seafood', 'Burgers', 'Wraps', 'Sides'
            ]),
            'Description' => fake()->sentence(),
            'Price' => fake()->randomFloat(2, 2, 50),
            'Status' => fake()->randomElement(['available', 'unavailable']),
            'Spicy_Level' => fake()->randomElement(['mild', 'medium', 'hot', null]),
            'Menu_Categories_ID' => MenuCategory::inRandomOrder()->first()->id,
        ];
    }
}