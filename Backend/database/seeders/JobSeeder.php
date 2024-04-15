<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            'Software Engineer',
            'Accountant',
            'Nurse',
            'Mechanical Engineer',
            'Marketing Manager',
            'Teacher',
            'Data Analyst',
            'Graphic Designer',
            'Sales Representative',
            'Human Resources Specialist'
        ];

        foreach ($jobs as $job) {
            DB::table('jobs')->insert([
                'name' => $job,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
