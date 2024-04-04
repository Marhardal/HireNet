<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Certificate extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('certificates')->insert([
            'name' => 'Information Systems',
            'field_id' => 1
        ]);
        DB::table('certificates')->insert([
            'name' => 'Information Technology',
            'field_id' => 1
        ]);
        DB::table('certificates')->insert([
            'name' => 'Data Science',
            'field_id' => 1
        ]);
        DB::table('certificates')->insert([
            'name' => 'Civil Engineering',
            'field_id' => 2
        ]);
        DB::table('certificates')->insert([
            'name' => 'Electric Engineering',
            'field_id' => 2
        ]);
        DB::table('certificates')->insert([
            'name' => 'Sciences',
            'field_id' => 3
        ]);
        DB::table('certificates')->insert([
            'name' => 'Humanities',
            'field_id' => 3
        ]);
        DB::table('certificates')->insert([
            'name' => 'Linguistics',
            'field_id' => 3
        ]);
    }
}
