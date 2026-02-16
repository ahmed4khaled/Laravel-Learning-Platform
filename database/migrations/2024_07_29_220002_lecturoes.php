<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create lectures table (model: Lecture).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('img')->nullable();
            $table->string('role');
            $table->string('price')->default('0');
            $table->integer('time')->nullable();
            $table->string('selling')->default('0');
            $table->string('monthly')->nullable();
            $table->string('name0')->nullable();
            $table->string('link0')->nullable();
            $table->string('grade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
