<?php

namespace Database\Seeders;

use App\Models\ProductionFocal;
use Illuminate\Database\Seeder;

class ProductionFocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductionFocal::factory(64)->create();
    }
}
