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
        Schema::create('legal_aspect_quiz_overviews', function (Blueprint $table) {
            $table->id();
            $table->foreignid('legal_aspect_quiz_categories_id')->constrained('legal_aspect_quiz_categories')->onDelete('cascade')->name('la_quiz_categories');
            $table->string('featured_image')->nullable();
            $table->string('title_question')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_aspect_quiz_overviews');
    }
};
