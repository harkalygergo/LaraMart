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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('icon')->default('bi bi-star');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // delete attributes table
        Schema::dropIfExists('attributes');
    }
};
