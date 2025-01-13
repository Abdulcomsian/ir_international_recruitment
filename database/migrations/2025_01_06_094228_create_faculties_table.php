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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('education_program_id');
            $table->string('title')->nullable();
            // $table->string('subheading')->nullable();
            $table->timestamps();

            $table->foreign('education_program_id')
                ->references('id')
                ->on('education_programs_details')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('faculities', function (Blueprint $table) {
            Schema::dropIfExists('faculties');

        });
    }
};
