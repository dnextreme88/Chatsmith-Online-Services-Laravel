<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'employee_number' => fake()->numberBetween(1, 99999),
            'employee_type' => fake()->randomElement([
                'OJT',
                'Regular',
                'Part-time'
            ]),
            'designation' => fake()->randomElement([
                'Baguio',
                'Pangasinan'
            ]),
            'role' => fake()->randomElement([
                'Administrator',
                'Director',
                'Employee',
                'Human Resources and Recruitment',
                'Owner',
                'Quality Analyst',
                'Supervisor',
                'Team Leader'
            ]),
            'date_hired' => fake()->dateTimeBetween('-8 years', '-6 years'),
            'date_resigned' => fake()->dateTimeBetween('-4 years'),
            'is_active' => fake()->randomElement([0, 1]),
            // Values are based on actual format
            'pag_ibig_number' => fake()->numerify('############'),
            'philhealth_number' => fake()->numerify('####-####-####'),
            'sss_number' => fake()->numerify('##-#######-#')
        ];
    }
}
