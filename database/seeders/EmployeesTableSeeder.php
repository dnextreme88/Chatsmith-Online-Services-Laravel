<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamp_value = '1580378520'; // Jan 30, 2020 06:02 PM

        Employee::create([
            'user_id' => 1,
            'employee_number' => 1,
            'employee_type' => 'Regular',
            'designation' => 'Baguio',
            'role' => 'Administrator',
            'is_active' => 'True',
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value
        ]);

        Employee::create([
            'user_id' => 2,
            'employee_number' => 2,
            'employee_type' => 'Regular',
            'designation' => 'Baguio',
            'role' => 'Human Resources and Recruitment',
            'is_active' => 'True',
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value
        ]);

        Employee::create([
            'user_id' => 3,
            'employee_number' => 3,
            'employee_type' => 'Regular',
            'designation' => 'Baguio',
            'role' => 'Owner',
            'is_active' => 'True',
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value
        ]);

        Employee::create([
            'user_id' => 4,
            'employee_number' => 371901,
            'employee_type' => 'Regular',
            'designation' => 'Baguio',
            'role' => 'Director',
            'is_active' => 'True',
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value
        ]);

        Employee::create([
            'user_id' => 5,
            'employee_number' => 9211803,
            'employee_type' => 'Regular',
            'designation' => 'Pangasinan',
            'role' => 'Supervisor',
            'is_active' => 'True',
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value
        ]);

        Employee::create([
            'user_id' => 6,
            'employee_number' => 2161701,
            'employee_type' => 'Regular',
            'designation' => 'Baguio',
            'role' => 'Team Leader',
            'is_active' => 'True',
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value
        ]);

        Employee::create([
            'user_id' => 7,
            'employee_number' => 2161801,
            'employee_type' => 'Regular',
            'designation' => 'Baguio',
            'role' => 'Supervisor',
            'is_active' => 'True',
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value
        ]);

        Employee::create([
            'user_id' => 8,
            'employee_number' => 6171019,
            'employee_type' => 'Part-time',
            'designation' => 'Baguio',
            'role' => 'Employee',
            'is_active' => 'False',
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value
        ]);

        Employee::create([
            'user_id' => 9,
            'employee_number' => 6171920,
            'employee_type' => 'Regular',
            'designation' => 'Baguio',
            'role' => 'Employee',
            'is_active' => 'True',
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value
        ]);

        Employee::create([
            'user_id' => 10,
            'employee_number' => 5261801,
            'employee_type' => 'Regular',
            'designation' => 'Baguio',
            'role' => 'Team Leader',
            'is_active' => 'False',
            'created_at' => $timestamp_value,
            'updated_at' => $timestamp_value
        ]);
    }
}
