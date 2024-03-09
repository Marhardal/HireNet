<?php

namespace Database\Factories;

use App\Models\Duty;
use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResumeDuties>
 */
class ResumeDutiesFactory extends Factory
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
            'duty_id' => Duty::get()->random()->id
        ];
    }
}
