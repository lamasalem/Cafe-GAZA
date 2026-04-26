<?php

namespace Database\Factories;

use App\Models\DiningTable;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'Order_Date' => fake()->dateTimeBetween('-1 month', 'now'),
            'Total_Amount' => fake()->randomFloat(2, 10, 500),
            'Payment_Method' => fake()->randomElement(['cash', 'card', 'e-wallet']),
            'Dining_Tables_ID' => DiningTable::inRandomOrder()->first()->id,
        ];
    }
}