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
        Schema::create('useful_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('diploma_id')->constrained('foreign_diplomas')->onDelete('cascade');
            $table->string('title');
            $table->string('visit_website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('useful_resources');
    }
};
