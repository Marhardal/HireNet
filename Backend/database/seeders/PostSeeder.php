<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizationIds = DB::table('organizations')->pluck('id')->toArray();

        foreach ($organizationIds as $organizationId) {
            // Fetching random job and arrangement IDs for each organization
            $jobId = DB::table('jobs')->inRandomOrder()->value('id');
            $arrangementId = DB::table('arrangements')->inRandomOrder()->value('id');

            // Creating 5 vacancies for each organization
            for ($i = 0; $i < 5; $i++) {
                DB::table('posts')->insert([
                    'job_id' => $jobId,
                    'about' => $this->generateRandomAbout(),
                    'due_date' => now()->addDays(7), // Due date set to 7 days from now
                    'organization_id' => $organizationId,
                    'arrangement_id' => $arrangementId,
                    'num' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    private function generateRandomAbout()
    {
        $aboutOptions = [
            'Explore exciting job opportunities with us!',
            'Join our team and make a difference in the world!',
            'We are looking for talented individuals to join our organization.',
            'Discover your potential with our innovative company.',
            'Become part of a dynamic team dedicated to success.',
            'Unlock your future with rewarding career opportunities!',
            'Grow professionally with our supportive work environment.',
            'Shape your career path with us!',
            'Kickstart your career with challenging projects.',
            'Experience growth and development with our company.'
        ];

        return $aboutOptions[array_rand($aboutOptions)];
    }
}
