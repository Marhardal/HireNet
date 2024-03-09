<?php

namespace Database\Factories;

use App\Models\Resume;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ResumeSkills>
 */
class ResumeSkillsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'resume_id'=>Resume::get()->random()->id,
            'skill_id'=>Skill::get()->random()->id,
        ];
    }
}
