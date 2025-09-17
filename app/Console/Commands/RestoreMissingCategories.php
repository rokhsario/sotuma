<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use Illuminate\Support\Str;

class RestoreMissingCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'categories:restore-missing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore missing categories that were accidentally deleted';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Restoring missing categories...');
        
        // Restore Moustiquaire en aluminium
        $moustiquaire = Category::create([
            'title' => 'Moustiquaire en aluminium',
            'description' => 'Systèmes de moustiquaires en aluminium pour fenêtres et portes, offrant protection contre les insectes tout en préservant la ventilation.',
            'slug' => Str::slug('Moustiquaire en aluminium'),
            'parent_id' => null
        ]);
        
        $this->info("Created: {$moustiquaire->title} (ID: {$moustiquaire->id})");
        
        // Restore Pergola en aluminium
        $pergola = Category::create([
            'title' => 'Pergola en aluminium',
            'description' => 'Pergolas et stores bras invisibles en aluminium, créant des espaces extérieurs élégants et fonctionnels.',
            'slug' => Str::slug('Pergola en aluminium'),
            'parent_id' => null
        ]);
        
        $this->info("Created: {$pergola->title} (ID: {$pergola->id})");
        
        // Add subcategories for Moustiquaire
        $moustiquaireSubcategories = [
            [
                'title' => 'Moustiquaires Fixes',
                'description' => 'Moustiquaires fixes pour fenêtres et portes, installation permanente.'
            ],
            [
                'title' => 'Moustiquaires Coulissantes',
                'description' => 'Moustiquaires coulissantes pour une utilisation flexible.'
            ],
            [
                'title' => 'Moustiquaires Roulantes',
                'description' => 'Moustiquaires roulantes pour économiser l\'espace.'
            ]
        ];
        
        foreach ($moustiquaireSubcategories as $subcat) {
            $category = Category::create([
                'title' => $subcat['title'],
                'description' => $subcat['description'],
                'slug' => Str::slug($subcat['title']),
                'parent_id' => $moustiquaire->id
            ]);
            $this->info("Created subcategory: {$category->title}");
        }
        
        // Add subcategories for Pergola
        $pergolaSubcategories = [
            [
                'title' => 'Pergolas Aluminium',
                'description' => 'Pergolas en aluminium pour terrasses et jardins.'
            ],
            [
                'title' => 'Stores Bras Invisibles',
                'description' => 'Stores bras invisibles en aluminium pour protection solaire.'
            ],
            [
                'title' => 'Systèmes Bioclimatiques',
                'description' => 'Systèmes bioclimatiques pour contrôle optimal du climat.'
            ]
        ];
        
        foreach ($pergolaSubcategories as $subcat) {
            $category = Category::create([
                'title' => $subcat['title'],
                'description' => $subcat['description'],
                'slug' => Str::slug($subcat['title']),
                'parent_id' => $pergola->id
            ]);
            $this->info("Created subcategory: {$category->title}");
        }
        
        $this->info('Missing categories restored successfully!');
        
        return 0;
    }
}
