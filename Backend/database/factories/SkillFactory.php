<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $currentIndex = 0;

    public function definition(): array
    {
        $skills = [
            'Communication Skills',
            'Teamwork',
            'Problem-Solving',
            'Leadership',
            'Time Management',
            'Creativity',
            'Adaptability',
            'Critical Thinking',
            'Attention to Detail',
            'Decision Making'
        ];
        $currentIndex = 0;
        $selectedSkill = $skills[$currentIndex];

$currentIndex = ($currentIndex + 1) % count($skills);
        return [
            'name' => $selectedSkill,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
