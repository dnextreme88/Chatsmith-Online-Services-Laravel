<?php

use Illuminate\Database\Seeder;
use App\Employee;

class EmployeesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Employee::create([
			'user_id' => 1,
			'employee_number' => 1,
			'employee_type' => 'Regular',
			'designation' => 'Baguio',
			'role' => 'Administrator',
			'is_active' => 'True',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);

		Employee::create([
			'user_id' => 2,
			'employee_number' => 2,
			'employee_type' => 'Regular',
			'designation' => 'Baguio',
			'role' => 'Human Resources and Recruitment',
			'is_active' => 'True',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);

		Employee::create([
			'user_id' => 3,
			'employee_number' => 3,
			'employee_type' => 'Regular',
			'designation' => 'Baguio',
			'role' => 'Owner',
			'is_active' => 'True',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);

		Employee::create([
			'user_id' => 4,
			'employee_number' => 371901,
			'employee_type' => 'Regular',
			'designation' => 'Baguio',
			'role' => 'Director',
			'is_active' => 'True',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);

		Employee::create([
			'user_id' => 5,
			'employee_number' => 6171019,
			'employee_type' => 'Part-time',
			'designation' => 'Baguio',
			'role' => 'Employee',
			'is_active' => 'False',
			'created_at' => '1580378520',
			'updated_at' => '1580378520',
		]);
	}
}
