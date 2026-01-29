<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * Uses the CarrierSeeder to populate the carriers table.
     */
    public function run(): void
    {
        $this->call([
        CarrierSeeder::class,
        ]);
    }
}
