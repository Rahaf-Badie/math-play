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
        Schema::create('game_content', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_games_id')->constrained('lesson_games')->onDelete('cascade');
            $table->text('question');
            $table->text('correct_answer');
            $table->json('options')->nullable();
            $table->integer('min_range')->nullable();
            $table->integer('max_range')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_content');
    }
};
