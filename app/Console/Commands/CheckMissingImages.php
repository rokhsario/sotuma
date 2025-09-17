<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckMissingImages extends Command
{
    protected $signature = 'check:missing-images';
    protected $description = 'Check which product images from seeder are missing';

    public function handle()
    {
        $this->info('Checking problematic product images:');
        $this->info('===================================');
        
        $problematicImages = [
            'images/products/6889f6e4cd993.jpg', // Prestige EX60
            'images/products/6889f7436f2ac.jpg', // Elipse 67
            'images/products/6889f7aad6c68.jpg', // Confort TS60
            'images/products/6889fa3f159f1.jpg', // Brises Soleil Rectangulaire
            'images/products/6889fa55226b1.png', // Brise Soleil Filante
            'images/products/6889fa76d0966.png', // Moustiquaire enroulable
            'images/products/6889fa8aacfb7.png', // Moustiquaire latéral simple
            'images/products/6889fa9e47592.png', // Moustiquaire latéral double
            'images/products/6889fab385c7f.png', // Moustiquaire plisée
        ];

        foreach ($problematicImages as $image) {
            $exists = file_exists(public_path($image)) ? 'EXISTS' : 'MISSING';
            $this->line("{$image}: {$exists}");
        }
    }
} 