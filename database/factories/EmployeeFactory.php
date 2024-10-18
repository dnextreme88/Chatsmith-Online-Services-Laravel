<?php

namespace Database\Factories;

use App\Enums\EmployeeRoles;
use App\Enums\EmployeeTypes;
use App\Enums\OfficeDesignations;
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
            'employee_type' => fake()->randomElement(EmployeeTypes::cases())->value,
            'designation' => fake()->randomElement(OfficeDesignations::cases())->value,
            'role' => fake()->randomElement(EmployeeRoles::cases())->value,
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
