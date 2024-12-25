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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('externalId')->nullable();
            $table->timestamps();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('images')->nullable();
            $table->string('url');
            $table->text('attributes')->nullable();
            $table->decimal('price', 8, 0)->default(0);
            $table->foreignId('user_id')->index()->references('id')->on('users')->onDelete('cascade');
            //$table->foreignId('category_id')->index()->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
