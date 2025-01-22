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
        Schema::create('legal_aspect_quiz_overview_labels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('legal_aspect_quiz_overviews_id')->constrained('legal_aspect_quiz_overviews')->onDelete('cascade')->name('laq-overview');
            $table->string('label');
            $table->string('label_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_aspect_quiz_overview_labels');
    }
};
