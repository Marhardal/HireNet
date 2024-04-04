<?php

namespace Database\Factories;

use App\Models\Duty;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostDuty>
 */
class PostDutyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id' => Post::all()->random()->id,
            'duties' => 'Identifying potential customers through door-to-door conversions, phone calls and attending industry events.
            Presenting company products and services to potation customers.
            Collaborating with other Direct Sales Agent to achieve goals and objectives.
            Assisting customers to complete necessary paperwork to complete loan sells.
            Working towards achieving sales goals set by the company.
            Providing post-sale assistance and support to customers questions, concerns, or outcomes.
            Adhering to company policies and standards in all sales activities.',
        ];
    }
}
