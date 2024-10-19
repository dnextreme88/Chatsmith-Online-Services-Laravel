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
        $is_active = fake()->randomElement([0, 1]);
        $date_resigned = $is_active == 0 ? fake()->dateTimeBetween('-4 years') : null;

        return [
            'user_id' => User::factory(),
            'employee_number' => fake()->numberBetween(1, 99999),
            'employee_type' => fake()->randomElement(EmployeeTypes::cases())->value,
            'designation' => fake()->randomElement(OfficeDesignations::cases())->value,
            'role' => fake()->randomElement(EmployeeRoles::cases())->value,
            'date_hired' => fake()->dateTimeBetween('-8 years', '-6 years'),
            'date_resigned' => $date_resigned,
            'is_active' => $is_active,
            // Values are based on actual format
            'pag_ibig_number' => fake()->numerify('############'),
            'philhealth_number' => fake()->numerify('####-####-####'),
            'sss_number' => fake()->numerify('##-#######-#')
        ];
    }
}
