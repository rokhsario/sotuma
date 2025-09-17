<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class UpdateProductImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:product-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update missing product images with available ones';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $productsPath = public_path('images/products');
        $availableImages = collect(File::files($productsPath))->map(function($file) {
            return 'images/products/' . $file->getFilename();
        })->toArray();

        $products = Product::all();
        $updated = 0;

        foreach ($products as $product) {
            // Check if current image exists
            if (!file_exists(public_path($product->image))) {
                // Assign a random available image
                $newImage = $availableImages[array_rand($availableImages)];
                $product->update(['image' => $newImage]);
                $updated++;
                
                $this->line("Updated {$product->title}: {$newImage}");
            }
        }

        $this->info("Updated {$updated} products with missing images");
    }
} 