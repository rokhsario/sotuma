<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class CheckProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check current products and their images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $products = Product::with('category')->get();
        
        $this->info('Current Products:');
        $this->info('================');
        
        foreach ($products as $product) {
            $this->line("• {$product->title}");
            $this->line("  Category: {$product->category->title}");
            $this->line("  Image: {$product->image}");
            $this->line("  Image exists: " . (file_exists(public_path($product->image)) ? 'YES' : 'NO'));
            $this->line('');
        }
        
        $this->info("Total: " . $products->count() . " products");
    }
} 