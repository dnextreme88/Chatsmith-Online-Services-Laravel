<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    public function definition(): array
    {
        $random_active_employee = Employee::where('is_staff', 1)
            ->isActive(1)
            ->inRandomOrder()
            ->first();
        $random_date = fake()->dateTimeBetween('-1 year', 'now');

        return [
            'user_id' => $random_active_employee->user_id,
            'title' => Str::title(fake()->words(rand(2, 5), true)),
            'description' => fake()->sentence(rand(3, 9)),
            'created_at' => $random_date,
            'updated_at' => $random_date
        ];
    }
}
