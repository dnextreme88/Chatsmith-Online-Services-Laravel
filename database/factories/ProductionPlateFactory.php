<?php

namespace Database\Factories;

use App\Enums\PlateIQTools;
use App\Models\TimeRange;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductionPlate>
 */
class ProductionPlateFactory extends Factory
{
    public function definition(): array
    {
        $random_user = User::inRandomOrder()->first();
        $random_time_range = TimeRange::inRandomOrder()->first();
        $random_date = $this->faker->dateTimeBetween('-2 months', 'now');
        $no_of_edits = fake()->numberBetween(0, 99);
        $no_of_invoices_completed = fake()->numberBetween(0, 99);
        $no_of_invoices_sent_to_manager = fake()->numberBetween(0, 99);

        return [
            'user_id' => $random_user->id,
            'employee_id' => $random_user->employee->id,
            'time_range_id' => $random_time_range->id,
            'account_used' => $random_user->email,
            'minutes_worked' => fake()->numberBetween(1, 60),
            'plateiq_tool' => fake()->randomElement(PlateIQTools::cases())->value,
            'no_of_edits' => $no_of_edits,
            'no_of_invoices_completed' => $no_of_invoices_completed,
            'no_of_invoices_sent_to_manager' => $no_of_invoices_sent_to_manager,
            'total_count' => $no_of_edits + $no_of_invoices_completed + $no_of_invoices_sent_to_manager,
            'created_at' => $random_date,
            'updated_at' => $random_date
        ];
    }
}
