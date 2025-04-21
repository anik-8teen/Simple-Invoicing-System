<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {/*
        $type= $this->faker->randomElement(['I','B']);
        $name = $type === 'I' ? $this->faker->name() : $this->faker->company();
*/

        return [
            
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(['individual', 'company']),
            'email' => $this->faker->email,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->post_code,


            /*
            'name' => $name,
            'type' => $type,
            'email' => $this->faker->email(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
    */
            
        ];
    }
}
