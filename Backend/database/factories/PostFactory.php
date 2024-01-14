<?php

namespace Database\Factories;

use App\Models\Arrangement;
use App\Models\Job;
use App\Models\Organisation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'organisation_id' => Organisation::all()->random()->id,
            'job_id' => Job::all()->random()->id,
            'arrangement_id' => Arrangement::all()->random()->id,
            'about' => fake()->paragraph(),
            'due_date' => now()->addMonth(3),
            'num' => fake()->randomNumber(),
        ];
    }
}
