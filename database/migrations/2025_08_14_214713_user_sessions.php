<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Add screen and device columns to user_sessions table.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_sessions', function (Blueprint $table) {
            $table->integer('screen_width')->nullable()->after('last_activity');
            $table->integer('screen_height')->nullable()->after('screen_width');
            $table->string('device_token')->nullable()->after('screen_height');
        });
    }

    public function down(): void
    {
        Schema::table('user_sessions', function (Blueprint $table) {
            $table->dropColumn(['screen_width', 'screen_height', 'device_token']);
        });
    }
};
