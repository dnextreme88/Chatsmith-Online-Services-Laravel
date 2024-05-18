<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TimeRange;

class TimeRangesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time_ranges = [
            '12:00 AM - 1:00 AM',
            '1:00 AM - 2:00 AM',
            '2:00 AM - 3:00 AM',
            '3:00 AM - 4:00 AM',
            '4:00 AM - 5:00 AM',
            '5:00 AM - 6:00 AM',
            '6:00 AM - 7:00 AM',
            '7:00 AM - 8:00 AM',
            '8:00 AM - 9:00 AM',
            '9:00 AM - 10:00 AM',
            '10:00 AM - 11:00 AM',
            '11:00 AM - 12:00 PM',
            '12:00 PM - 1:00 PM',
            '1:00 PM - 2:00 PM',
            '2:00 PM - 3:00 PM',
            '3:00 PM - 4:00 PM',
            '4:00 PM - 5:00 PM',
            '5:00 PM - 6:00 PM',
            '6:00 PM - 7:00 PM',
            '7:00 PM - 8:00 PM',
            '8:00 PM - 9:00 PM',
            '9:00 PM - 10:00 PM',
            '10:00 PM - 11:00 PM',
            '11:00 PM - 12:00 AM',
        ];

        foreach ($time_ranges as $time_range) {
            TimeRange::create([
                'time_range' => $time_range,
            ]);
        }
    }
}
