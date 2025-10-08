<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('title_line1')->nullable()->after('title_break_index_2');
            $table->string('title_line2')->nullable()->after('title_line1');
            $table->string('title_line3')->nullable()->after('title_line2');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['title_line1','title_line2','title_line3']);
        });
    }
};


