<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class CleanupCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'categories:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up duplicate categories and keep only properly structured ones';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Cleaning up categories...');
        
        // Keep only the categories with proper structure (IDs 20-47)
        $categoriesToKeep = Category::whereBetween('id', [20, 47])->get();
        $categoriesToDelete = Category::whereNotBetween('id', [20, 47])->get();
        
        $this->info("Categories to keep: {$categoriesToKeep->count()}");
        $this->info("Categories to delete: {$categoriesToDelete->count()}");
        
        if ($this->confirm('Do you want to proceed with the cleanup?')) {
            foreach ($categoriesToDelete as $category) {
                $this->line("Deleting: {$category->title} (ID: {$category->id})");
                $category->delete();
            }
            
            $this->info('Cleanup completed!');
            
            // Regenerate slugs for remaining categories
            $this->call('categories:generate-slugs');
        } else {
            $this->info('Cleanup cancelled.');
        }
        
        return 0;
    }
}
