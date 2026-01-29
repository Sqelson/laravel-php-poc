<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Carrier;

class CarrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Carrier::create(['name' => 'Royal Mail', 'price' => 4.99, 'max_weight' => 5]);
        Carrier::create(['name' => 'DPD', 'price' => 12.50, 'max_weight' => 20]);
        Carrier::create(['name' => 'BigFreight', 'price' => 45.00, 'max_weight' => 100]);
    }
}
