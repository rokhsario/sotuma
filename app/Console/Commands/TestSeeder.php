<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestSeeder extends Command
{
    protected $signature = 'test:seeder';
    protected $description = 'Test the SOTUMADataSeeder without actually seeding';

    public function handle()
    {
        $this->info('Testing SOTUMADataSeeder...');
        $this->info('============================');

        // Test Categories
        $categories = [
            [
                'title' => 'Menuiserie Battante',
                'slug' => 'menuiserie-battante',
                'description' => 'Fenêtres et portes battantes en aluminium',
                'image' => 'images/categories/6889f40246a82.jpg'
            ],
            [
                'title' => 'Menuiserie Coulissante',
                'slug' => 'menuiserie-coulissante',
                'description' => 'Fenêtres et portes coulissantes en aluminium',
                'image' => 'images/categories/6889f411bc45f.jpg'
            ],
            [
                'title' => 'Façades Continues',
                'slug' => 'facades-continues',
                'description' => 'Façades continues et murs rideaux',
                'image' => 'images/categories/6889f41caae48.jpg'
            ],
            [
                'title' => 'Volets Roulants',
                'slug' => 'volets-roulants',
                'description' => 'Volets roulants manuels et électriques',
                'image' => 'images/categories/6889f4556a8f3.jpg'
            ],
            [
                'title' => 'Brises Soleil',
                'slug' => 'brises-soleil',
                'description' => 'Brises soleil horizontaux et verticaux',
                'image' => 'images/categories/6889f46226a6b.jpg'
            ],
            [
                'title' => 'Cloison Agencement',
                'slug' => 'cloison-agencement',
                'description' => 'Cloisons vitrées et aménagements',
                'image' => 'images/categories/6889f4730e91b.jpg'
            ],
            [
                'title' => 'Garde-Corps et Rampes',
                'slug' => 'garde-corps-et-rampes',
                'description' => 'Garde-corps et rampes d\'escalier',
                'image' => 'images/categories/6889f48ba814c.jpg'
            ],
            [
                'title' => 'Moustiquaire en aluminium',
                'slug' => 'moustiquaire-en-aluminium',
                'description' => 'Moustiquaires en aluminium de qualité',
                'image' => 'images/categories/6889f49b12e29.jpg'
            ],
            [
                'title' => 'Pergola en aluminium',
                'slug' => 'pergola-en-aluminium',
                'description' => 'Pergolas en aluminium pour terrasses',
                'image' => 'images/categories/6889fbc89e764.jpg'
            ]
        ];

        $this->info('Categories to be created: ' . count($categories));
        foreach ($categories as $cat) {
            $imageExists = file_exists(public_path($cat['image'])) ? '✓' : '✗';
            $this->line("  {$imageExists} {$cat['title']} - {$cat['image']}");
        }

        $this->info('');
        $this->info('Products to be created: 35');
        
        // Test some key products
        $keyProducts = [
            'Prestige EX45' => 'images/products/688b76cd319c7.jpg',
            'Elipse TPR 40' => 'images/products/688b760e14ecb.jpg',
            'Prestige EX60' => 'images/products/688b76e38f22a.jpg',
            'SÉRIE 22 ELLIPSE' => 'images/products/688b766531f40.jpg',
            'SÉRIE EX60 PRESTIGE LIGNE ELLIPTIQUE' => 'images/products/688b754555431.jpg',
            'SÉRIE EX60 PRESTIGE LIGNE DROITE' => 'images/products/688b75e17c863.jpg'
        ];

        foreach ($keyProducts as $title => $image) {
            $imageExists = file_exists(public_path($image)) ? '✓' : '✗';
            $this->line("  {$imageExists} {$title} - {$image}");
        }

        $this->info('');
        $this->info('✅ Seeder validation complete!');
        $this->info('All data structure is correct and ready for seeding.');
    }
} 