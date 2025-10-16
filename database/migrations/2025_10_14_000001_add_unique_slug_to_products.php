<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up() {
        // Ensure slug column exists; if not, add it
        if (!Schema::hasColumn('products', 'slug')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
            });
        }

        // Backfill and deduplicate existing slugs
        $products = DB::table('products')->select('id', 'title', 'slug')->orderBy('id')->get();
        $seen = [];
        foreach ($products as $prod) {
            $base = $prod->slug ?: Str::slug($prod->title ?: 'produit');
            if ($base === '') { $base = 'produit'; }
            $candidate = $base;
            $counter = 1;
            while (in_array($candidate, $seen, true) || DB::table('products')->where('slug', $candidate)->where('id', '!=', $prod->id)->exists()) {
                $candidate = $base.'-'.$counter;
                $counter++;
            }
            $seen[] = $candidate;
            if ($candidate !== $prod->slug) {
                DB::table('products')->where('id', $prod->id)->update(['slug' => $candidate]);
            }
        }

        // Add unique index (safe even if it already exists)
        Schema::table('products', function (Blueprint $table) {
            try {
                $table->unique('slug');
            } catch (\Throwable $e) {
                // index may already exist; ignore
            }
        });
    }

    public function down() {
        // Drop unique index if exists
        Schema::table('products', function (Blueprint $table) {
            try { $table->dropUnique('products_slug_unique'); } catch (\Throwable $e) {}
            try { $table->dropUnique(['slug']); } catch (\Throwable $e) {}
        });
        // Keep slug column for safety; don't drop to avoid data loss
    }
};


