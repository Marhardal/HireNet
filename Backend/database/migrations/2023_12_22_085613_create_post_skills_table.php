<?php

use App\Models\Post;
use App\Models\Skill;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Skill::class)->onDelete('cascade');
            $table->foreignIdFor(Post::class)->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_skills');
    }
};
