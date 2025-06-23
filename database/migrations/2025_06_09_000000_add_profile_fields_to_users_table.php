<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('bio')->nullable()->after('interest');
            $table->text('description')->nullable()->after('bio');
            $table->string('yt')->nullable()->after('description');
            $table->string('ig')->nullable()->after('yt');
            $table->string('fb')->nullable()->after('ig');
            $table->string('tiktok')->nullable()->after('fb');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['bio', 'description', 'yt', 'ig', 'fb', 'tiktok']);
        });
    }
};
