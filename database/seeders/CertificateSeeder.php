<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;

class CertificateSeeder extends Seeder
{
    public function run()
    {
        Certificate::create([
            'title' => "Certificat d’Agrément – Profilés Aluminium (Tunisie)",
            'image' => 'certificates/agrement-tunisie.jpg',
            'description' => "Ce certificat atteste que nos profilés aluminium respectent les normes tunisiennes les plus strictes en matière de qualité, de durabilité et de sécurité. Il est délivré par les autorités compétentes et garantit la conformité de nos produits pour tous vos projets architecturaux en Tunisie."
        ]);
        Certificate::create([
            'title' => "Certificat de Conformité – Export Europe",
            'image' => 'certificates/conformite-europe.jpg',
            'description' => "Ce certificat valide la conformité de nos profilés aluminium aux exigences européennes (CE), permettant leur exportation et leur utilisation sur l’ensemble du marché européen. Il témoigne de notre engagement envers l’excellence et l’innovation à l’international."
        ]);
    }
} 