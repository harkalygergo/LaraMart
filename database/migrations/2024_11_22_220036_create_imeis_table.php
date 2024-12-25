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
        Schema::create('imeis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('imei');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('os')->nullable();
            $table->string('storage')->nullable();
            $table->string('data_source');
            $table->text('data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imei');
    }
};
