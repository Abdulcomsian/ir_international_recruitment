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
        Schema::create('history_quebecs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('quebec_history_categories')->onDelete('cascade');
            $table->string('featured_image')->nullable();
            $table->string('title')->nullable();
            $table->longText('blog')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_quebecs');
    }
};
