<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Add exam_id foreign key to lectures table.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lectures', function (Blueprint $table) {
            $table->foreignId('exam_id')
                ->nullable()
                ->after('grade')
                ->constrained('exams')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('lectures', function (Blueprint $table) {
            $table->dropForeign(['exam_id']);
        });
    }
};
