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
            // Remove old fields
            $table->dropColumn(['logo', 'photo', 'description']);
            
            // Add new fields
            $table->string('presentation_image')->nullable()->after('short_des');
            $table->string('hero_slogan')->nullable()->after('presentation_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // Restore old fields
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('photo')->nullable();
            
            // Remove new fields
            $table->dropColumn(['presentation_image', 'hero_slogan']);
        });
    }
};
