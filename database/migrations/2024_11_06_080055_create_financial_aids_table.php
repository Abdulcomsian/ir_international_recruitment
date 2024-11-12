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
        Schema::create('financial_aids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs');
            $table->string('title')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('link')->nullable(); //here add the link for details
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_aids');
    }
};
