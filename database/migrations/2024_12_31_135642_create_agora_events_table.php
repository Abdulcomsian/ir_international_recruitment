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
        Schema::create('agora_events', function (Blueprint $table) {
            $table->id();
            $table->string('img');
            $table->string('title');
            $table->decimal('price', 65, 2)->nullable();
            $table->string('hosted_by');
            $table->text('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agora_events');
    }
};
