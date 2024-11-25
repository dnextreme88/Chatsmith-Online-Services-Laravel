<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* TODO: ARCHIVED, FOR HISTORICAL PURPOSES FOR NOW SINCE WE ARE USING A FACTORY TO GENERATE FAKE DATA
        $this->call(UsersSeeder::class);
        */

        $this->call(EmployeesSeeder::class);

        $this->call(AnnouncementsSeeder::class);
        $this->call(TimeRangesSeeder::class);
        $this->call(ProductionChatSeeder::class);
        $this->call(ProductionFocalSeeder::class);
        $this->call(ProductionPlateSeeder::class);
    }
}
