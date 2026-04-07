<?php

namespace Database\Seeders;

use App\Models\InternetService;
use Illuminate\Database\Seeder;

class InternetServiceSeeder extends Seeder
{
    public function run(): void
    {
        InternetService::factory(10)->create();
    }
}