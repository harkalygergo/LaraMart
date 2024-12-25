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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // add to user_id column a foreign key constraint that references id column on users table
            $table->foreignId('recipient_id')->constrained('users')->onDelete('cascade');
            // add Ad column
            $table->foreignId('ad_id')->constrained('ads')->onDelete('cascade');
            // add message column
            $table->text('message');
            // add read_at column
            $table->timestamp('read_at')->nullable();
            // add created_at and updated_at columns
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            Schema::dropIfExists('messages');
        });
    }
};
