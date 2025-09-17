<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class CheckCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check current categories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $categories = Category::all();
        
        $this->info('Current Categories:');
        $this->info('==================');
        
        foreach ($categories as $category) {
            $this->line("• {$category->title}");
            $this->line("  Slug: {$category->slug}");
            $this->line("  Image: {$category->image}");
            $this->line("  Description: {$category->description}");
            $this->line('');
        }
        
        $this->info("Total: " . $categories->count() . " categories");
    }
}
