<?php

namespace Database\Factories;
use App\Models\customer;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       // $status=$this->faker->randomElement(['B','P','V']);
        return [
            'customer_id' => Customer::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $this->faker->randomElement(['unpaid', 'paid']),
            'billed_date' => $this->faker->dateTimeThisMonth(),
            'paid_date' => $this->faker->dateTimeThisMonth(),






/*
            'customer_id' =>customer::factory(),
            'amount'=> $this->faker->numberBetween(100,100000),
            'status'=> $status,
            'bill_date'=> $this->faker->dateTimeThisDecade(),
            'paid_date'=> $this->faker->dateTimeThisDecade()
*/
        ];
    }
}
