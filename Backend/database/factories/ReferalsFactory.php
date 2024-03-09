<?php

namespace Database\Factories;

use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Referals>
 */
class ReferalsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'resume_id' => Resume::get()->random()->id,
            'full_name'=>fake()->name(),
            'phone'=>fake()->phoneNumber(),
            'email'=>fake()->email()
        ];
    }
}
