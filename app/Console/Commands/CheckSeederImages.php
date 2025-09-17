<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CheckSeederImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:seeder-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check which images from SOTUMADataSeeder exist';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Category images from seeder
        $categoryImages = [
            'images/categories/6889f40246a82.jpg',
            'images/categories/6889f411bc45f.jpg',
            'images/categories/6889f41caae48.jpg',
            'images/categories/6889f4556a8f3.jpg',
            'images/categories/6889f46226a6b.jpg',
            'images/categories/6889f4730e91b.jpg',
            'images/categories/6889f48ba814c.jpg',
            'images/categories/6889f49b12e29.jpg',
            'images/categories/6889fbc89e764.jpg'
        ];

        // Product images from seeder
        $productImages = [
            'images/products/6889f4e0c814b.jpg',
            'images/products/6889f5fb612e9.jpg',
            'images/products/6889f60f485e0.jpg',
            'images/products/6889f6211e287.jpg',
            'images/products/6889f6e4cd993.jpg',
            'images/products/6889f7436f2ac.jpg',
            'images/products/6889f7aad6c68.jpg',
            'images/products/6889f7c94b268.jpg',
            'images/products/6889f7f37f55f.png',
            'images/products/6889f812cf031.png',
            'images/products/6889f834631d2.jpg',
            'images/products/6889f87ac3ed9.png',
            'images/products/6889f896de08a.png',
            'images/products/6889f8bfa422c.jpg',
            'images/products/6889f92465c1b.png',
            'images/products/6889f95c8888c.png',
            'images/products/6889f9a012bcf.png',
            'images/products/6889f9c679da3.png',
            'images/products/6889f9ed97d7e.png',
            'images/products/6889fa3f159f1.jpg',
            'images/products/6889fa55226b1.png',
            'images/products/6889fa76d0966.png',
            'images/products/6889fa8aacfb7.png',
            'images/products/6889fa9e47592.png',
            'images/products/6889fab385c7f.png',
            'images/products/6889fae0ad2a3.jpg',
            'images/products/6889fb0524b60.jpg',
            'images/products/6889fb19538e1.jpg',
            'images/products/6889fb4265daf.jpg',
            'images/products/6889fb6109b9e.jpg',
            'images/products/6889fb7412afd.jpg',
            'images/products/6889fbee506b2.jpg'
        ];

        $this->info('Checking Category Images:');
        $this->info('=======================');
        foreach ($categoryImages as $image) {
            $exists = file_exists(public_path($image)) ? '✓ EXISTS' : '✗ MISSING';
            $this->line("{$image}: {$exists}");
        }

        $this->info('');
        $this->info('Checking Product Images:');
        $this->info('=======================');
        foreach ($productImages as $image) {
            $exists = file_exists(public_path($image)) ? '✓ EXISTS' : '✗ MISSING';
            $this->line("{$image}: {$exists}");
        }

        $this->info('');
        $this->info('Summary:');
        $this->info('========');
        $missingCategories = array_filter($categoryImages, function($img) {
            return !file_exists(public_path($img));
        });
        $missingProducts = array_filter($productImages, function($img) {
            return !file_exists(public_path($img));
        });

        $this->info('Missing category images: ' . count($missingCategories));
        $this->info('Missing product images: ' . count($missingProducts));
    }
} 