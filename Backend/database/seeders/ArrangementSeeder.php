<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArrangementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('arrangements')->insert([
            'name' => 'Contract'
        ]);

        DB::table('arrangements')->insert([
            'name' => 'Full Time'
        ]);

        DB::table('arrangements')->insert([
            'name' => 'Part Time'
        ]);

        DB::table('arrangements')->insert([
            'name' => 'Voluntary'
        ]);

        DB::table('arrangements')->insert([
            'name' => 'Internship'
        ]);
    }
}
