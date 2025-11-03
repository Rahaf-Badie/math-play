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
        Schema::create('game_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_game_id')->constrained('lesson_games')->onDelete('cascade');
            $table->integer('min_range')->nullable();
            $table->integer('max_range')->nullable();
            $table->string('operation_type')->nullable(); // مثلاً: "addition" أو "subtraction"
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_settings');
    }
};
