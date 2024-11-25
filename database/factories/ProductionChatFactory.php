<?php

namespace Database\Factories;

use App\Enums\ChatAccountTools;
use App\Models\TimeRange;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductionChat>
 */
class ProductionChatFactory extends Factory
{
    public function definition(): array
    {
        $random_user = User::inRandomOrder()->first();
        $random_time_range = TimeRange::inRandomOrder()->first();
        $random_date = $this->faker->dateTimeBetween('-2 months', 'now');

        return [
            'user_id' => $random_user->id,
            'employee_id' => $random_user->employee->id,
            'time_range_id' => $random_time_range->id,
            'account_used' => $random_user->email,
            'minutes_worked' => fake()->numberBetween(1, 60),
            'chat_account_tool' => fake()->randomElement(ChatAccountTools::cases())->value,
            'created_at' => $random_date,
            'updated_at' => $random_date
        ];
    }
}
