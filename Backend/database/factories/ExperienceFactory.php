<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\Organisation;
use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'resume_id' => Resume::all()->random()->id,
            'job_id' => Job::all()->random()->id,
            'organisation' => "MobiPay",
            'duties' => "<ul>
                        <li>Developed and maintained web applications using Laravel framework.</li>
                        <li>Implemented responsive and user-friendly front-end interfaces using HTML, CSS, and JavaScript.</li>
                        <li>Designed and optimized database schemas for efficient data storage and retrieval.</li>
                        <li>Integrated third-party APIs to enhance application functionality and improve user experience.</li>
                        <li>Collaborated with cross-functional teams to gather requirements, plan projects, and deliver solutions on time and within budget.</li>
                        <li>Performed code reviews and provided constructive feedback to team members to ensure code quality and maintainability.</li>
                        <li>Identified and resolved technical issues and bugs to ensure smooth operation of web applications.</li>
                        <li>Kept abreast of industry trends and emerging technologies to continuously improve skills and stay competitive in the field.</li>
                    </ul>",
            'start' => "2022-02",
            'end' => "2022-05",
        ];
    }
}
