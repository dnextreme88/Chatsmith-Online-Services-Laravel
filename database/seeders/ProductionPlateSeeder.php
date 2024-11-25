<?php

namespace Database\Seeders;

use App\Models\ProductionPlate;
use Illuminate\Database\Seeder;

class ProductionPlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductionPlate::factory(64)->create();
    }
}
