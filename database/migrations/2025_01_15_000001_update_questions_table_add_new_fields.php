<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Add question_type, points, explanation, is_active, question_image to questions.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->enum('question_type', ['multiple_choice', 'true_false', 'essay'])->default('multiple_choice')->after('question');
            $table->integer('points')->default(1)->after('correct_option');
            $table->text('explanation')->nullable()->after('points');
            $table->boolean('is_active')->default(true)->after('explanation');
            $table->string('question_image')->nullable()->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn([
                'question_type',
                'points',
                'explanation',
                'is_active',
                'question_image'
            ]);
        });
    }
};
