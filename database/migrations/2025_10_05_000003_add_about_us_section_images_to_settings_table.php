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
            $columns = [
                'about_presentation_image',
                'about_mission_image',
                'about_objectives_image',
                'about_expertise_image',
                'about_approach_image',
            ];

            foreach ($columns as $col) {
                if (!Schema::hasColumn('settings', $col)) {
                    $table->string($col)->nullable()->after('about_hero_bg');
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $columns = [
                'about_presentation_image',
                'about_mission_image',
                'about_objectives_image',
                'about_expertise_image',
                'about_approach_image',
            ];

            foreach ($columns as $col) {
                if (Schema::hasColumn('settings', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};


