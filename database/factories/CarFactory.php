<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word, 
            'type' => $this->faker->randomElement(['Sedan', 'SUV', 'Coupe']),
            'price_per_day' => $this->faker->randomFloat(2, 20, 100), 
            'availability_status' => $this->faker->randomElement(['available', 'unavailable']),
        ];
    }
}
