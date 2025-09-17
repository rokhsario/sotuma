<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class CheckCategoryImages extends Command
{
    protected $signature = 'check:category-images';
    protected $description = 'Check what images are assigned to each category';

    public function handle()
    {
        $categories = Category::all();
        
        $this->info("Current category images:");
        
        foreach ($categories as $category) {
            $this->line("- {$category->title}: {$category->image}");
        }
        
        return 0;
    }
} 