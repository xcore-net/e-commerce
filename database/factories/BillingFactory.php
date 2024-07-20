<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Billing>
 */
class BillingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $creditNumber = (int)fake()->creditCardNumber();
        return [
            'type' => fake()->randomElement(['visa', 'paypal']),
            'number' => fake()->creditCardNumber(),
           
        ];
    }
}
