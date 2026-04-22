<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Add description, max_attempts, is_active, dates, totals to exams.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('exams')) {
            return;
        }

        Schema::table('exams', function (Blueprint $table) {
            if (!Schema::hasColumn('exams', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
            if (!Schema::hasColumn('exams', 'max_attempts')) {
                $table->integer('max_attempts')->default(1)->after('duration_min');
            }
            if (!Schema::hasColumn('exams', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('max_attempts');
            }
            if (!Schema::hasColumn('exams', 'start_date')) {
                $table->timestamp('start_date')->nullable()->after('is_active');
            }
            if (!Schema::hasColumn('exams', 'end_date')) {
                $table->timestamp('end_date')->nullable()->after('start_date');
            }
            if (!Schema::hasColumn('exams', 'total_questions')) {
                $table->integer('total_questions')->default(0)->after('end_date');
            }
            if (!Schema::hasColumn('exams', 'total_points')) {
                $table->integer('total_points')->default(0)->after('total_questions');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('exams')) {
            return;
        }

        Schema::table('exams', function (Blueprint $table) {
            $columns = [];

            foreach (['description', 'max_attempts', 'is_active', 'start_date', 'end_date', 'total_questions', 'total_points'] as $column) {
                if (Schema::hasColumn('exams', $column)) {
                    $columns[] = $column;
                }
            }

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
