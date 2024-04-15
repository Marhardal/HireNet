<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $degrees = [
            'Computer Science',
            'Business Administration',
            'Nursing',
            'Mechanical Engineering',
            'Psychology',
            'Electrical Engineering',
            'Education',
            'Finance',
            'Marketing',
            'Information Technology'
        ];

        foreach ($degrees as $degree) {
            DB::table('certificates')->insert([
                'name' => 'Degree in ' . $degree,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
