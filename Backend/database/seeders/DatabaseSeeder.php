<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Applicant;
use App\Models\Bookmark;
use App\Models\Certificate;
use App\Models\Job;
use App\Models\Duty;
use App\Models\Post;
use App\Models\User;
use App\Models\Skill;
use App\Models\PostDuty;
use App\Models\PostSkills;
use App\Models\Requirement;
use App\Models\Organisation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Organisation::factory(2)->create();

        // $this->call([
        //     RoleSeeder::class,
        // ]);

        // $this->call([
        //     ArrangementSeeder::class
        // ]);

        User::factory(5)->create();
        Applicant::factory(20)->create();
        // Job::factory(10)->create();
        // Duty::factory(30)->create();
        // Skill::factory(30)->create();
        // Post::factory(10)->create();
        // PostSkills::factory(30)->create();
        // PostDuty::factory(30)->create();
        // Certificate::factory(30)->create();
        // Requirement::factory(30)->create();
        // Bookmark::factory(5)->create();
    }
}
