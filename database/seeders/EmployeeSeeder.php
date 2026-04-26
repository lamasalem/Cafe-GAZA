<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = Employee::factory(5)->create();

        foreach ($employees as $employee) {
            $employee->user()->create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->phoneNumber(),
                'password' => Hash::make('123456'),
                'role' => 'employee',
            ]);
        }
    }
}