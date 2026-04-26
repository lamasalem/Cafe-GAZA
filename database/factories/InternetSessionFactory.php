<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\InternetService;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternetSessionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'Start_Time' => fake()->dateTimeBetween('-1 month', 'now'),
            'End_Time' => fake()->dateTimeBetween('now', '+2 hours'),
            'Access_Code' => fake()->bothify('WIFI-####'),
            'Status' => fake()->randomElement(['active', 'expired', 'cancelled']),
            'Orders_ID' => Order::inRandomOrder()->first()->id,
            'Internet_Services_ID' => InternetService::inRandomOrder()->first()->id,
        ];
    }
}