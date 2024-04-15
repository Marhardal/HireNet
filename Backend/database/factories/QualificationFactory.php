<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Certificate;
use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requirement>
 */
class QualificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $duties = [
            'Manage and prioritize multiple tasks efficiently',
            'Collaborate with cross-functional teams to achieve project goals',
            'Communicate effectively with stakeholders at all levels',
            'Analyze and interpret data to make informed decisions',
            'Troubleshoot and resolve technical issues promptly',
            'Adapt to changing priorities and work under pressure',
            'Develop and implement strategies for process improvement',
            'Ensure compliance with industry regulations and standards',
            'Provide exceptional customer service',
            'Conduct research and stay updated with industry trends'
        ];

        $requirements = '<ul>';
        foreach ($duties as $duty) {
            $requirements .= '<li>' . $duty . '</li>';
        }
        $requirements .= '</ul>';

        return [
            'resume_id' => Resume::all()->random()->id,
            'certificate_id' => 10,
            'school' => "Nacit",
            'started' => "2023-07",
            'finished' => "2024-05",
        ];
    }
}
