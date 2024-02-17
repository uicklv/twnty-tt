<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'salary' => fake()->numberBetween(1000, 5000),
            'country_id' => Country::all()->random()->id,
            'position_id' => Position::all()->random()->id,
            'age' => fake()->numberBetween(18, 65),
        ];
    }
}
