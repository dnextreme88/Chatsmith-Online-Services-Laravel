<?php

namespace Database\Seeders;

use App\Models\ProductionChat;
use Illuminate\Database\Seeder;

class ProductionChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductionChat::factory(64)->create();
    }
}
