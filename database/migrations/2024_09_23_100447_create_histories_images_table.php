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
        Schema::create('histories_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('history_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('image')->nullable();
            $table->string('type')->nullable(); // history, events
            $table->foreign('history_id')->on('histories')->references('id');
            $table->foreign('event_id')->on('events')->references('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories_images');
    }
};
