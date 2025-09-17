<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class UpdateCategoryImages extends Command
{
    protected $signature = 'update:category-images';
    protected $description = 'Update category images with actual images';

    public function handle()
    {
        $updates = [
            'Façades Continues' => 'images/brise_soleil.jpg',
            'Menuiseries Aluminium' => 'images/coulisant.jpg',
            'Vérandas et Pergolas' => 'images/TS60-Confort.jpg',
            'Garde-corps' => 'images/garde-corps-verre-aluminium.jpg',
            'Escaliers Aluminium' => 'images/rampes-escalier-barreaux.jpg',
            'Cloisons Vitrées' => 'images/technique1-cloison.jpg',
            'Portes Automatiques' => 'images/EX60.jpg',
            'Accessoires Aluminium' => 'images/batton.jpg'
        ];

        foreach ($updates as $title => $image) {
            $category = Category::where('title', $title)->first();
            if ($category) {
                $category->update(['image' => $image]);
                $this->info("Updated {$title} with {$image}");
            } else {
                $this->error("Category {$title} not found");
            }
        }

        $this->info('All category images updated!');
        return 0;
    }
} 