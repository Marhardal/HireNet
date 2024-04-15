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
            'job_id' => $this->faker->numberBetween(1, 10), // Assuming there are 10 jobs
            'about' => $this->faker->text,
            'due_date' => $this->faker->dateTimeBetween('+1 week', '+6 months'),
            'organisation_id' => function () {
                return mt_rand(1, 5); // Assuming there are 5 organisations
            },
            'arrangement_id' => $this->faker->numberBetween(1, 3), // Assuming arrangement_id ranges from 1 to 3
            'num' => 1,
        ];
    }
}
