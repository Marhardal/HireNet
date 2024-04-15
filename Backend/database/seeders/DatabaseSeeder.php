<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Job;
use App\Models\Duty;
use App\Models\Post;
use App\Models\User;
use App\Models\Skill;
use App\Models\Resume;
use App\Models\Bookmark;
use App\Models\PostDuty;
use App\Models\Referals;
use App\Models\Applicant;
use App\Models\PostSkills;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Requirement;
use App\Models\Organisation;
use App\Models\Qualification;
use App\Models\Referrals;
use App\Models\Responsibilities;
use App\Models\ResumeDuties;
use App\Models\ResumeSkills;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use App\Models\ResumeQualification;
use Database\Factories\ResponsibilitiesFactory;
use Database\Seeders\ArrangementSeeder;
use JobSeeder;
use OrganizationSeeder;
use PostSeeder;
use PostSkillSeeder;
use RequirementSeeder;
use SkillSeeder;

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
        //     FieldSeeder::class,
        // ]);

        // $this->call([
        //     ArrangementSeeder::class
        // ]);

        // $this->call([
        //     CertificateSeeder::class
        // ]);

        // User::factory(5)->create();
        // Job::factory(10)->create();
        // Skill::factory(10)->create();
        // Post::factory(10)->create();
        // PostSkills::factory(30)->create();
        // Resume::factory(1)->create();
        // Experience::factory(1)->create();
        // ResumeSkills::factory(5)->create();
        // Qualification::factory(1)->create();
        // Referrals::factory(3)->create();
        Applicant::factory(30)->create();
        // PostDuty::factory(30)->create();
        // Certificate::factory(10)->create();
        // Requirement::factory(10)->create();
        // Responsibilities::factory(30)->create();
        // Qualification::factory(10)->create();
        // Bookmark::factory(5)->create();
    }
}
