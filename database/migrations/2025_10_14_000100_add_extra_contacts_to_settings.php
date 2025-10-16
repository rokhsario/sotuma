<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'phone2')) {
                $table->string('phone2')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('settings', 'email2')) {
                $table->string('email2')->nullable()->after('email');
            }
            if (!Schema::hasColumn('settings', 'email3')) {
                $table->string('email3')->nullable()->after('email2');
            }
        });
    }

    public function down() {
        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'email3')) {
                $table->dropColumn('email3');
            }
            if (Schema::hasColumn('settings', 'email2')) {
                $table->dropColumn('email2');
            }
            if (Schema::hasColumn('settings', 'phone2')) {
                $table->dropColumn('phone2');
            }
        });
    }
};


