<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     **/
 
    public function definition(): array
    {
        $status = $this->faker->randomElement(['B', 'P', 'V']);

        return [
            'customer_id' => Customer::factory(),
            'amount' => $this->faker->numberBetween( 100, 10000),
            'status' => $status,
            'billed_date' => $this->faker->dateTimeBetween(),
            'paid_date' => $status === 'P' ? $this->faker->dateTimeThisDecade() : null, 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

