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
        if (!Schema::hasTable('questions')) {
            return;
        }

        Schema::table('questions', function (Blueprint $table) {
            if (!Schema::hasColumn('questions', 'question_type')) {
                $table->enum('question_type', ['multiple_choice', 'true_false', 'essay'])->default('multiple_choice')->after('question');
            }
            if (!Schema::hasColumn('questions', 'points')) {
                $table->integer('points')->default(1)->after('correct_option');
            }
            if (!Schema::hasColumn('questions', 'explanation')) {
                $table->text('explanation')->nullable()->after('points');
            }
            if (!Schema::hasColumn('questions', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('explanation');
            }
            if (!Schema::hasColumn('questions', 'question_image')) {
                $table->string('question_image')->nullable()->after('is_active');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('questions')) {
            return;
        }

        Schema::table('questions', function (Blueprint $table) {
            $columns = [];

            foreach (['question_type', 'points', 'explanation', 'is_active', 'question_image'] as $column) {
                if (Schema::hasColumn('questions', $column)) {
                    $columns[] = $column;
                }
            }

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
