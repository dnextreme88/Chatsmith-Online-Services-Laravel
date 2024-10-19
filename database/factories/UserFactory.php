<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    public function definition(): array
    {
        $first_name = fake()->firstName();
        $last_name = fake()->lastName();

        $has_user = User::where('first_name', $first_name)->first();
        if ($has_user) {
            $first_name = fake()->firstName();
        }

        return [
            'first_name' => $first_name,
            'maiden_name' => fake()->lastName(),
            'last_name' => $last_name,
            'email' => 'chatsmithonline.' .strtolower($first_name). '@example.com',
            'username' => str_replace('\'', '', strtolower($last_name. $first_name). $this->faker->numberBetween(1, 99)),
            'phone_number' => fake()->numerify('+639#########'),
            'address' => fake()->address(),
            'is_staff' => fake()->randomElement([0, 1]),
            'profile_photo_path' => null,
            'password' => static::$password ??= Hash::make('cos12345'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
