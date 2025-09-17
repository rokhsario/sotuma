<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class FixProductImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:fix-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix product images by assigning available images to products without images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fixing product images...');
        
        // Get all available product images
        $imagePath = public_path('images/products');
        $availableImages = [];
        
        if (File::exists($imagePath)) {
            $files = File::files($imagePath);
            foreach ($files as $file) {
                if (in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $availableImages[] = 'images/products/' . $file->getFilename();
                }
            }
        }
        
        if (empty($availableImages)) {
            $this->error('No product images found in public/images/products/');
            return 1;
        }
        
        $this->info("Found " . count($availableImages) . " available images");
        
        // Get products without images or with non-existent images
        $products = Product::all();
        $fixedCount = 0;
        
        foreach ($products as $product) {
            $needsFix = false;
            
            // Check if product has no image
            if (empty($product->image)) {
                $needsFix = true;
            } else {
                // Check if image file exists
                $imagePath = public_path($product->image);
                if (!File::exists($imagePath)) {
                    $needsFix = true;
                }
            }
            
            if ($needsFix) {
                // Assign a random available image
                $randomImage = $availableImages[array_rand($availableImages)];
                $product->update(['image' => $randomImage]);
                $this->line("Fixed: {$product->title} -> {$randomImage}");
                $fixedCount++;
            }
        }
        
        $this->info("Fixed {$fixedCount} products");
        
        return 0;
    }
}
