<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleCheckFactory extends Factory
{
    public function definition(): array
    {
        return [
            'current_odometer' => fake()->numberBetween(10000, 100000),
            'previous_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'previous_odometer' => fake()->numberBetween(0, 100000),
        ];
    }
}
