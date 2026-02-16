<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create assignmentsums table (assignment submissions – model: AssignmentSum).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignmentsums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lecture_id')->constrained('lectures')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('file_path')->nullable();
            $table->text('teacher_notes')->nullable();
            $table->text('notes')->nullable();
            $table->string('grade')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignmentsums');
    }
};
