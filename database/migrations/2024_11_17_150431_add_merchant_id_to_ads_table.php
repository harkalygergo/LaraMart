<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->unsignedBigInteger('merchant_id')->nullable(); // Add the column
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('set null'); // Add foreign key constraint
        });
    }

    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropForeign(['merchant_id']); // Drop the foreign key
            $table->dropColumn('merchant_id');    // Drop the column
        });
    }
};
