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
    Schema::create('lessons', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('unit_id');
        $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
        $table->text('description')->nullable();
        $table->string('video_url')->nullable();
        $table->string('pdf_path')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
