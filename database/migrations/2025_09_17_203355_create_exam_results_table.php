<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id();
            // المفتاح الأجنبي للطلاب
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // المفتاح الأجنبي للوحدات
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->integer('score');
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};
