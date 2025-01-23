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
        Schema::create('legal_quiz_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('legal_aspect_questions_id')->constrained('legal_aspect_questions')->onDelete('cascade');
            $table->string('answer_text')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_quiz_options');
    }
};
