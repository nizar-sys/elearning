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
        Schema::create('elearning_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('elearning_id')->constrained('elearnings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('material_id')->constrained('materials')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elearning_materials');
    }
};
