<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();

        foreach(range(1, 5) as $index){
            DB::table('users')->insert([
                'first_name' => $this->faker->firstName,
                'last_name' => $this->faker->lastName,
                'email' => $this->unique()->safeEmail,
                'password' => bcrypt('password'),
                'role' => 4,
                'email_verified_at' => Carbon::now()
            ]);
        }
    }
}
