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
        Schema::create('titles_descriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('history_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('type')->nullable(); // history, events
            $table->foreign('event_id')->on('events')->references('id');
            $table->foreign('history_id')->on('histories')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('titles_descriptions');
    }
};
