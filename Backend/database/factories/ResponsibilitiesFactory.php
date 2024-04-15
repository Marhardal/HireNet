<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Certificate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Requirement>
 */
class ResponsibilitiesFactory extends Factory
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
            'post_id' => Post::all()->random()->id,

            'duties' => $requirements,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
