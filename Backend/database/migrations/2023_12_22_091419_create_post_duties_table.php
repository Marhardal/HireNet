<?php

use App\Models\Duty;
use App\Models\Post;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_duties', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Post::class)->onDelete('cascade');
            $table->text('duties');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_duties');
    }
};
