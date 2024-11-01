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
        Schema::create('validation_guides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diploma_id')->constrained('foreign_diplomas')->onDelete('cascade');
            $table->string('validation_organization')->nullable();
            $table->string('visit_website')->nullable();
            $table->text('validation_guides')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validation_guides');
    }
};
