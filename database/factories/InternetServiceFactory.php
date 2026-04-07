<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InternetServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'service_name' => fake()->randomElement([
                'Basic', 'Standard', 'Premium', 'VIP',
                'Student', 'Business', 'Family', 'Unlimited'
            ]),
            'speed' => fake()->randomElement(['10 Mbps', '25 Mbps', '50 Mbps', '100 Mbps', '200 Mbps']),
            'price' => fake()->randomFloat(2, 3, 50),
        ];
    }
}