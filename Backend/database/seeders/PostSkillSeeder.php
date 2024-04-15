<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetching all skill IDs and post IDs
        $skillIds = DB::table('skills')->pluck('id')->toArray();
        $postIds = DB::table('posts')->pluck('id')->toArray();

        // Generate random associations between skills and posts
        foreach ($postIds as $postId) {
            // Randomly select a subset of skills for each post
            $numberOfSkills = rand(2, 5); // Random number of skills per post (between 2 and 5)
            $selectedSkillIds = array_rand(array_flip($skillIds), $numberOfSkills);

            // Insert associations into the database
            foreach ($selectedSkillIds as $skillId) {
                DB::table('post_skills')->insert([
                    'post_id' => $postId,
                    'skill_id' => $skillId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
