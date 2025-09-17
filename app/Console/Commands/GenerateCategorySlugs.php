<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use Illuminate\Support\Str;

class GenerateCategorySlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'categories:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for all categories that do not have them';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating slugs for categories...');

        $categories = Category::whereNull('slug')->orWhere('slug', '')->get();
        
        if ($categories->isEmpty()) {
            $this->info('All categories already have slugs!');
            return 0;
        }

        $bar = $this->output->createProgressBar($categories->count());
        $bar->start();

        foreach ($categories as $category) {
            $baseSlug = Str::slug($category->title);
            $slug = $baseSlug;
            $counter = 1;

            // Check if slug already exists and make it unique
            while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $category->update(['slug' => $slug]);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Successfully generated slugs for ' . $categories->count() . ' categories!');

        return 0;
    }
}
