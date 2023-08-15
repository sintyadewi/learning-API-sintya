<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'     => fake()->numberBetween(1, 18),
            'title'       => fake()->secondaryAddress(),
            'street'      => fake()->streetAddress(),
            'postal_code' => fake()->postcode(),
        ];
    }
}
