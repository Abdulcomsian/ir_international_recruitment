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
        Schema::create('culture_overview_labels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('culture_overview_id')->constrained('culture_overviews')->onDelete('cascade');
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
        Schema::dropIfExists('culture_overview_labels');
    }
};
