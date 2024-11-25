<?php

namespace Database\Factories;

use App\Models\TimeRange;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductionFocal>
 */
class ProductionFocalFactory extends Factory
{
    public function definition(): array
    {
        $random_user = User::inRandomOrder()->first();
        $random_time_range = TimeRange::inRandomOrder()->first();
        $random_date = $this->faker->dateTimeBetween('-2 months', 'now');
        $oos_count = fake()->numberBetween(0, 99);
        $not_oos_count = fake()->numberBetween(0, 99);
        $discard_count = fake()->numberBetween(0, 99);

        return [
            'user_id' => $random_user->id,
            'employee_id' => $random_user->employee->id,
            'time_range_id' => $random_time_range->id,
            'account_used' => $random_user->email,
            'minutes_worked' => fake()->numberBetween(1, 60),
            'oos_count' => $oos_count,
            'not_oos_count' => $not_oos_count,
            'discard_count' => $discard_count,
            'total_count' => $oos_count + $not_oos_count + $discard_count,
            'created_at' => $random_date,
            'updated_at' => $random_date
        ];
    }
}
