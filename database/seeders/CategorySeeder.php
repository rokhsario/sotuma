<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => 'VOLETS ROULANTS ALUMINIUM',
                'slug' => 'volets-roulants-aluminium',
                'summary' => null,
                'photo' => null,
                'is_parent' => 1,
                'parent_id' => null,
                'added_by' => null
            ],
            [
                'title' => 'FAÇADES MUR RIDEAUX',
                'slug' => 'facades-mur-rideaux',
                'summary' => null,
                'photo' => null,
                'is_parent' => 1,
                'parent_id' => null,
                'added_by' => null
            ],
            [
                'title' => 'GARDE CORPS',
                'slug' => 'garde-corps',
                'summary' => null,
                'photo' => null,
                'is_parent' => 1,
                'parent_id' => null,
                'added_by' => null
            ],
            [
                'title' => 'PORTE',
                'slug' => 'porte-de-garage',
                'summary' => null,
                'photo' => null,
                'is_parent' => 1,
                'parent_id' => null,
                'added_by' => null
            ],
            [
                'title' => 'DIVERS',
                'slug' => 'divers',
                'summary' => null,
                'photo' => null,
                'is_parent' => 1,
                'parent_id' => null,
                'added_by' => null
            ],
            [
                'title' => 'MOUSTIQUAIRE',
                'slug' => 'moustiquaire',
                'summary' => null,
                'photo' => null,
                'is_parent' => 1,
                'parent_id' => null,
                'added_by' => null
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
