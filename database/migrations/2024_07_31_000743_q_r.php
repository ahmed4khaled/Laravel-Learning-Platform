<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Create qrs table (QR codes – model: QrCode).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qrs', function (Blueprint $table) {
            $table->id();
            $table->string('qr');
            $table->string('value')->default('0');
            $table->string('user_id')->nullable()->default('0');
            $table->string('role');
            $table->string('copon')->nullable();
            $table->string('std')->default('0');
            $table->string('Lecname')->nullable()->default('0');
            $table->string('discount')->nullable()->default('0');
            $table->string('phone')->nullable();
            $table->timestamp('used')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qrs');
    }
};
