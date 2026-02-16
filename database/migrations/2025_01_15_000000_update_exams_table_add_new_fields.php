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
        Schema::table('exams', function (Blueprint $table) {
            $table->text('description')->nullable()->after('title');
            $table->integer('max_attempts')->default(1)->after('duration_min');
            $table->boolean('is_active')->default(true)->after('max_attempts');
            $table->timestamp('start_date')->nullable()->after('is_active');
            $table->timestamp('end_date')->nullable()->after('start_date');
            $table->integer('total_questions')->default(0)->after('end_date');
            $table->integer('total_points')->default(0)->after('total_questions');
        });
    }

    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'max_attempts',
                'is_active',
                'start_date',
                'end_date',
                'total_questions',
                'total_points'
            ]);
        });
    }
};
