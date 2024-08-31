<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;

class AnnouncementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp_value = '1580378520'; // Jan 30, 2020 06:02 PM

        Announcement::create([
            'user_id' => 3,
            'title' => 'Welcome to COS',
            'description' => 'Hello! I am Ms. Mary Grace Torio, the owner of COS and I am delighted to welcome you to my company.',
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value
        ]);

        Announcement::create([
            'user_id' => 2,
            'title' => 'Happy Independence Day!',
            'description' => 'Happy holidays, everyone! It\'s a Friday and it\'s also payday!',
            'created_at' => '1591935132',
            'updated_at' => '1591935132'
        ]);
    }
}
