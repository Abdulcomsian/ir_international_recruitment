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
        Schema::create('quebec_legal_aspects', function (Blueprint $table) {
            $table->id();
            $table->string('img');
            $table->string('title');
            $table->enum('type',['key_navigation', 'faq', 'useful_links', 'legal_aid', 'quiz'])->nullable();
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quebec_legal_aspects');
    }
};
