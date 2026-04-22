<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create users table (model: User).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('Phone')->unique()->nullable();
            $table->string('Phone_par')->nullable();
            $table->string('class')->nullable();
            $table->string('type')->default('std');
            $table->string('school')->nullable();
            $table->string('numnational')->unique()->nullable();
            $table->string('role')->default('std');
            $table->unsignedBigInteger('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
