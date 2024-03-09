<?php

use App\Models\Duty;
use App\Models\Resume;
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
        Schema::create('resume_duties', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Resume::class);
            $table->foreignIdFor(Duty::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_duties');
    }
};
