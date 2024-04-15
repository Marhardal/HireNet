<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizations = [
            [
                'name' => 'TechHub',
                'location' => 'Blantyre',
                'about' => 'TechHub is a technology-focused organization aimed at promoting innovation and entrepreneurship in Malawi.',
            ],
            [
                'name' => 'HealthFirst',
                'location' => 'Lilongwe',
                'about' => 'HealthFirst is a healthcare organization dedicated to providing quality medical services to the community.',
            ],
            [
                'name' => 'EduCare',
                'location' => 'Zomba',
                'about' => 'EduCare is an educational organization committed to providing access to quality education for all.',
            ],
            // Add more organizations as needed
        ];

        foreach ($organizations as $organization) {
            DB::table('organizations')->insert([
                'name' => $organization['name'],
                'location' => $organization['location'],
                'about' => $organization['about'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
