<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create answerlecs table (lecture question answers – model: AnswerLec).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('answerlecs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionlec_id')->constrained('questionlecs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('content');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answerlecs');
    }
};
