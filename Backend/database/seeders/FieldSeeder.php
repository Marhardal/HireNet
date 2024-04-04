<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fields')->insert(
            [
                'name' => 'Computer Science'
            ]
        );
        DB::table('fields')->insert(
            [
                'name' => 'Engineering'
            ]
        );
        DB::table('fields')->insert(
            [
                'name' => 'Education'
            ]
        );
        // DB::table('fields')->insert(
        //     [
        //         'name' => 'Computer Science'
        //     ]
        // );
    }
}
