<?php

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
        Schema::create('elearning_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('elearning_id')->constrained('elearnings')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('reviewer_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('review');
            $table->string('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elearning_reviews');
    }
};
