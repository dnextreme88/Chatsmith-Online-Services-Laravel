<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* TODO: ARCHIVED, FOR HISTORICAL PURPOSES FOR NOW SINCE WE ARE USING A FACTORY TO GENERATE FAKE DATA
        $this->call(UsersTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        */

        Employee::factory(32)->create();

        $this->call(AnnouncementsTableSeeder::class);
        $this->call(TimeRangesTableSeeder::class);
    }
}
