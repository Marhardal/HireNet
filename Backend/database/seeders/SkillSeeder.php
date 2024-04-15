<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            'Programming',
            'Leadership',
            'Communication',
            'Problem Solving',
            'Time Management',
            'Critical Thinking',
            'Teamwork',
            'Adaptability',
            'Creativity',
            'Analytical Skills'
        ];

        foreach ($skills as $skill) {
            DB::table('skills')->insert([
                'name' => $skill,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
