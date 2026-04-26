<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DiningTableSeeder::class,
            MenuCategorySeeder::class,
            InternetServiceSeeder::class,
            EmployeeSeeder::class,
            CustomerSeeder::class,
            OrderSeeder::class,
            MenuItemSeeder::class,
            InternetSessionSeeder::class,
        ]);
    }
}