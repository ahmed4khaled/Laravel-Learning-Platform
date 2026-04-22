<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create questions table (exam questions - model: Question).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained()->onDelete('cascade');
            $table->text('question');
            $table->enum('question_type', ['multiple_choice', 'true_false', 'essay'])->default('multiple_choice');
            $table->string('option_a')->nullable();
            $table->string('option_b')->nullable();
            $table->string('option_c')->nullable();
            $table->string('option_d')->nullable();
            $table->enum('correct_option', ['a', 'b', 'c', 'd'])->nullable();
            $table->integer('points')->default(1);
            $table->text('explanation')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('question_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
