<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apply>
 */
class ApplicantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->where('role_id', 2)->random()->id,
            'post_id' => Post::all()->random()->id,
            'document'=> '/Resumes/qCzt4PBRmx8FHvbFUW6VIldDZBNbS1elaTveCwEN.pdf',
            'message' => fake()->paragraph(2)
        ];
    }
}
