<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'Job_Title' => fake()->randomElement([
                'Waiter',
                'Chef',
                'Barista',
                'Cashier',
                'Manager',
                'Cleaner',
                'Receptionist',
                'Supervisor'
            ]),
        ];
    }
}