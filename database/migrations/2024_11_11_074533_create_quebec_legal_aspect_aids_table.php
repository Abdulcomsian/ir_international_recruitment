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
        Schema::create('quebec_legal_aspect_aids', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quebec_legal_aspect_id');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('img');
            $table->string('title');
            $table->string('email');
            $table->string('phone_no');
            $table->text('address');
            $table->foreign('quebec_legal_aspect_id')->references('id')->on('quebec_legal_aspects')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quebec_legal_aspect_aids');
    }
};
