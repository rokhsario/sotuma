<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'title' => 'Lame Extrudée TPR757 et TPR758',
                'description' => '<p>Dim Max = 4*3</p>',
                'photo' => '/storage/photos/1/prod1.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Lame Extrudée TPR791',
                'description' => '<p>Dim Max = 5*2.4</p>',
                'photo' => '/storage/photos/1/prod2.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Lame Extrudée TPR754',
                'description' => '<p>Dim Max = 6.5*4</p>',
                'photo' => '/storage/photos/1/prod3.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Lame Extrudée 80 TPR836',
                'description' => '<p>Dim Max = 5*2.4</p>',
                'photo' => '/storage/photos/1/prod4.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Lame Acier Injectée',
                'description' => '<p>Dim Max = 4*3</p>',
                'photo' => '/storage/photos/1/prod5.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Lame Orientable',
                'description' => '<p>Dim Max = 2*2.2</p>',
                'photo' => '/storage/photos/1/prod6.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Lame PVC',
                'description' => '<p>Dim Max 2*2.2</p>',
                'photo' => '/storage/photos/1/prod7.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Lame Injecté',
                'description' => '<p>Dim Max 2*2.2</p>',
                'photo' => '/storage/photos/1/prod8.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Lame Avec Trou et Plexiglass',
                'description' => '<p>Dim Max 4*3</p>',
                'photo' => '/storage/photos/1/prod9.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Lame Transmission Par Chaine',
                'description' => '<p>Dim Max 2.5*2.4</p>',
                'photo' => '/storage/photos/1/prod10.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Lame Perforée',
                'description' => '<p>Dim Max 3*2.2</p>',
                'photo' => '/storage/photos/1/prod11.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Lame Avec Fonte',
                'description' => '<p>Dim Max 3*2.2</p>',
                'photo' => '/storage/photos/1/prod12.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Lame Avec Fonte Moustiquaire',
                'description' => '<p>Dim Max 3*2.2</p>',
                'photo' => '/storage/photos/1/prod13.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Lame Plat Moustiquaire',
                'description' => '<p>Dim Max 2.5*2.2</p>',
                'photo' => '/storage/photos/1/prod14.png',
                'cat_id' => 1,
                'status' => 'active'
            ],
            [
                'title' => 'Façade A Trame Horizontale',
                'description' => '<p>Donne un effet visuel de lignes continues horiz...</p>',
                'photo' => '/storage/photos/1/prod15.png',
                'cat_id' => 2,
                'status' => 'active'
            ],
            [
                'title' => 'Façade Traditionnelle (TRD)',
                'description' => '<p>C\'est un système de façade composée de panneaux...</p>',
                'photo' => '/storage/photos/1/prod16.png',
                'cat_id' => 2,
                'status' => 'active'
            ],
            [
                'title' => 'Façade A Vitrage Extérieur Collé (VEC)',
                'description' => '<p>C\'est un système de façade où les vitrages sont...</p>',
                'photo' => '/storage/photos/1/prod17.png',
                'cat_id' => 2,
                'status' => 'active'
            ],
            [
                'title' => 'Façade A Vitrage Extérieur Parclosé (VEP)',
                'description' => '<p>C\'est un système de façade où les vitrages sont...</p>',
                'photo' => '/storage/photos/1/prod18.png',
                'cat_id' => 2,
                'status' => 'active'
            ],
            [
                'title' => 'Garde Corps Systéme En Verre',
                'description' => null,
                'photo' => '/storage/photos/1/prod19.png',
                'cat_id' => 3,
                'status' => 'active'
            ],
            [
                'title' => 'Garde Corps Systéme A Panneaux Vitrée',
                'description' => null,
                'photo' => '/storage/photos/1/prod20.png',
                'cat_id' => 3,
                'status' => 'active'
            ],
            [
                'title' => 'Garde Corps Systéme A Barre Verticale Ou Horizanta...',
                'description' => null,
                'photo' => '/storage/photos/1/prod21.png',
                'cat_id' => 3,
                'status' => 'active'
            ],
            [
                'title' => 'Porte Garage Extérieur',
                'description' => null,
                'photo' => '/storage/photos/1/prod22.png',
                'cat_id' => 4,
                'status' => 'active'
            ],
            [
                'title' => 'Porte Garage Intérieur',
                'description' => null,
                'photo' => '/storage/photos/1/prod23.png',
                'cat_id' => 4,
                'status' => 'active'
            ],
            [
                'title' => 'Porte Garage Sectionnelle',
                'description' => null,
                'photo' => '/storage/photos/1/prod24.png',
                'cat_id' => 4,
                'status' => 'active'
            ],
            [
                'title' => 'Porte Exterieur A La Francaise',
                'description' => null,
                'photo' => '/storage/photos/1/prod25.png',
                'cat_id' => 4,
                'status' => 'active'
            ],
            [
                'title' => 'Porte Garage Basculant',
                'description' => null,
                'photo' => '/storage/photos/1/prod26.png',
                'cat_id' => 4,
                'status' => 'active'
            ],
            [
                'title' => 'Porte Exterieur Coulissant',
                'description' => null,
                'photo' => '/storage/photos/1/prod27.png',
                'cat_id' => 4,
                'status' => 'active'
            ],
            [
                'title' => 'Porte Blindé',
                'description' => null,
                'photo' => '/storage/photos/1/Prod28.png',
                'cat_id' => 4,
                'status' => 'active'
            ],
            [
                'title' => 'Porte Accordéon',
                'description' => null,
                'photo' => '/storage/photos/1/prod29.png',
                'cat_id' => 4,
                'status' => 'active'
            ],
            [
                'title' => 'Porte Sécurit',
                'description' => null,
                'photo' => '/storage/photos/1/prod30.png',
                'cat_id' => 4,
                'status' => 'active'
            ],
            [
                'title' => 'Brise Soleil Fixe',
                'description' => null,
                'photo' => '/storage/photos/1/prod31.png',
                'cat_id' => 5,
                'status' => 'active'
            ],
            [
                'title' => 'Brise Soleil Mobile',
                'description' => null,
                'photo' => '/storage/photos/1/prod32.png',
                'cat_id' => 5,
                'status' => 'active'
            ],
            [
                'title' => 'Grille de Ventilation',
                'description' => null,
                'photo' => '/storage/photos/1/prod33.png',
                'cat_id' => 5,
                'status' => 'active'
            ],
            [
                'title' => 'Brise Soleil Bso',
                'description' => null,
                'photo' => '/storage/photos/1/prod34.png',
                'cat_id' => 5,
                'status' => 'active'
            ],
            [
                'title' => 'Moustiquaire Latéral Double',
                'description' => null,
                'photo' => '/storage/photos/1/prod35.png',
                'cat_id' => 6,
                'status' => 'active'
            ],
            [
                'title' => 'Moustiquaire Plisée',
                'description' => null,
                'photo' => '/storage/photos/1/prod36.png',
                'cat_id' => 6,
                'status' => 'active'
            ],
            [
                'title' => 'Moustiquaire Latéral Simple',
                'description' => null,
                'photo' => '/storage/photos/1/prod37.png',
                'cat_id' => 6,
                'status' => 'active'
            ],
            [
                'title' => 'Moustiquaire Enroulable',
                'description' => null,
                'photo' => '/storage/photos/1/prod38.png',
                'cat_id' => 6,
                'status' => 'active'
            ]
        ];

        foreach ($products as $product) {
            $product['slug'] = Str::slug($product['title']);
            Product::create($product);
        }
    }
}
