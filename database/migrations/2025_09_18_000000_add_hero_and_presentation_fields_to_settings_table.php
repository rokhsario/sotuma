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
        Schema::table('settings', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('settings', 'hero_slogan')) {
                $table->string('hero_slogan')->nullable()->after('short_des');
            }
            if (!Schema::hasColumn('settings', 'presentation_image')) {
                $table->string('presentation_image')->nullable()->after('hero_slogan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'hero_slogan')) {
                $table->dropColumn('hero_slogan');
            }
            if (Schema::hasColumn('settings', 'presentation_image')) {
                $table->dropColumn('presentation_image');
            }
        });
    }
};
