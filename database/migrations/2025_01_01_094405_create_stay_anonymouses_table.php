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
        Schema::create('stay_anonymouses', function (Blueprint $table) {
            $table->id();
            $table->integer('complain_no')->unique();
            $table->string('img_proof')->nullable();
            $table->string('voice_msg')->nullable();
            $table->string('address');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stay_anonymouses');
    }
};
