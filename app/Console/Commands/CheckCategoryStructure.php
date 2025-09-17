<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class CheckCategoryStructure extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'categories:check-structure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and fix category structure to ensure all categories are parent categories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking category structure...');
        
        $categories = Category::all();
        
        if ($categories->isEmpty()) {
            $this->info('No categories found.');
            return 0;
        }
        
        $this->info("Found {$categories->count()} categories:");
        
        foreach ($categories as $category) {
            $parentStatus = $category->parent_id ? 'Subcategory' : 'Parent';
            $this->line("- {$category->id}: {$category->title} ({$parentStatus})");
        }
        
        // Check if any categories have parent_id
        $subcategories = Category::whereNotNull('parent_id')->get();
        
        if ($subcategories->count() > 0) {
            $this->warn("Found {$subcategories->count()} subcategories. Converting them to parent categories...");
            
            foreach ($subcategories as $subcategory) {
                $subcategory->update(['parent_id' => null]);
                $this->line("Converted: {$subcategory->title} -> Parent category");
            }
            
            $this->info('All categories are now parent categories.');
        } else {
            $this->info('All categories are already parent categories.');
        }
        
        return 0;
    }
}
