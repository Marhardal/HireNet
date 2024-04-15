<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resume>
 */
class ResumeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 6,
            'summary' => "An accomplished software engineer with over 5 years of experience in full-stack web development. Skilled in PHP, Laravel, JavaScript, and React.js. Proven track record of delivering high-quality solutions that meet client needs and exceed expectations.",
        ];
    }
}
