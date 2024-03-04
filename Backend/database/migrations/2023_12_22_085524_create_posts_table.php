<?php

use App\Models\Job;
use App\Models\Arrangement;
use App\Models\Organisation;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Organisation::class);
            $table->foreignIdFor(Job::class);
            $table->foreignIdFor(Arrangement::class);
            $table->boolean('status')->default(false);
            $table->integer('num');
            $table->text('about');
            $table->date('due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
