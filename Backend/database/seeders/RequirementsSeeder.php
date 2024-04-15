<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetching all certificate IDs and post IDs
        $certificateIds = DB::table('certificates')->pluck('id')->toArray();
        $postIds = DB::table('posts')->pluck('id')->toArray();

        // Generate random requirements and associate them with a certificate and a post
        foreach ($certificateIds as $certificateId) {
            foreach ($postIds as $postId) {
                // Generating 3 to 5 random requirements for each certificate-post combination
                $numberOfRequirements = rand(3, 5);
                $requirements = $this->generateRandomRequirements($numberOfRequirements);

                // Insert requirements into the database and associate them with the certificate and post
                foreach ($requirements as $requirement) {
                    DB::table('requirements')->insert([
                        'certificate_id' => $certificateId,
                        'post_id' => $postId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Generate random requirements.
     *
     * @param int $count
     * @return array
     */
    private function generateRandomRequirements($count)
    {
        $requirements = [];

        for ($i = 0; $i < $count; $i++) {
            $requirements[] = 'Lorem ipsum requirement ' . ($i + 1); // Replace with your requirement generation logic
        }

        return $requirements;
    }
}
