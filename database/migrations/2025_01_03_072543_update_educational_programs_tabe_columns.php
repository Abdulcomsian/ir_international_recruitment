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
        Schema::table('eduction_programs', function (Blueprint $table) {
            // Rename 'location' to 'city_id' and change type to unsignedBigInteger
            $table->unsignedBigInteger('city_id')->nullable()->after('university_type');

            // If the 'location' column already exists, drop it
            $table->dropColumn('location');

            // Optional: Add foreign key constraint if referencing a 'cities' table
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('eduction_programs', function (Blueprint $table) {
            // Re-add the 'location' column as a string
            $table->string('location')->nullable()->after('university_type');

            // Drop the 'city_id' column and its foreign key constraint
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
        });
    }
};
