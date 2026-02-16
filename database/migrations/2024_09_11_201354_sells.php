<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create sells table (lecture purchases – model: Sale).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('std');
            $table->string('id_lec');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sells');
    }
};
