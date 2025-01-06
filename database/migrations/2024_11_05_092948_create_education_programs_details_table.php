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
        Schema::create('education_programs_details', function (Blueprint $table) {
            $table->id();
            $table->ForeignId('eduction_programs_id')->constrained('eduction_programs')->onDelete('cascade');
            $table->string('address')->nullable();
            $table->longText('about')->nullable();
            $table->longText('financial_aid')->nullable();
            $table->longText('campus')->nullable();
            $table->longText('faculties')->nullable();
            $table->longText('additional_program')->nullable();
            $table->longText('research')->nullable();
            $table->longText('student_life')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_programs_details');
    }
};
