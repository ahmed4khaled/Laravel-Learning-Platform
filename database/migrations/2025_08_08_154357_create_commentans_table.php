<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create commentsans table (comments on lecture answers – model: Commentsans).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commentsans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('answerlec_id')->constrained('answerlecs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commentsans');
    }
};
