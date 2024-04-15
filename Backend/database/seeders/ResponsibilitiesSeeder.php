<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponsibilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fetching all post IDs
        $postIds = DB::table('posts')->pluck('id')->toArray();

        // Generate random responsibilities and associate them with a post
        foreach ($postIds as $postId) {
            // Generating 3 to 5 random responsibilities for each post
            $numberOfResponsibilities = rand(3, 5);
            $responsibilities = $this->generateRandomResponsibilities($numberOfResponsibilities);

            // Insert responsibilities into the database and associate them with the post
            foreach ($responsibilities as $responsibility) {
                DB::table('responsibilities')->insert([
                    'content' => $responsibility,
                    'post_id' => $postId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Generate random responsibilities.
     *
     * @param int $count
     * @return array
     */
    private function generateRandomResponsibilities($count)
    {
        $responsibilities = [];

        for ($i = 0; $i < $count; $i++) {
            $responsibility = '<ul>';
            $numberOfItems = rand(3, 5);

            for ($j = 0; $j < $numberOfItems; $j++) {
                $responsibility .= '<li>' . $this->getRandomResponsibilityItem() . '</li>';
            }

            $responsibility .= '</ul>';

            $responsibilities[] = $responsibility;
        }

        return $responsibilities;
    }

    /**
     * Get a random responsibility item.
     *
     * @return string
     */
    private function getRandomResponsibilityItem()
    {
        $responsibilityItems = [
            'Develop and implement software applications.',
            'Collaborate with team members to deliver high-quality code.',
            'Participate in code reviews and provide constructive feedback.',
            'Prepare financial statements and reports.',
            'Manage accounts payable and receivable.',
            'Conduct financial analysis and forecasting.',
            'Provide patient care in various healthcare settings.',
            'Administer medications and treatments as prescribed.',
            'Collaborate with healthcare professionals to plan patient care.',
            // Add more responsibility items as needed
        ];

        return $responsibilityItems[array_rand($responsibilityItems)];
    }
}
