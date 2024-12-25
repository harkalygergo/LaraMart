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
        Schema::table('ads', function (Blueprint $table) {
            $table->string('categoryType1', 32)->nullable();
            $table->string('categoryType2', 32)->nullable();
            $table->string('categoryType3', 32)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('categoryType1');
            $table->dropColumn('categoryType2');
            $table->dropColumn('categoryType3');
        });
    }
};
