<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Categories (updated with current data and new images)
        DB::table('categories')->insert([
            ["id"=>4,"title"=>"Volets Roulants","image"=>"images/categories/6889f4556a8f3.jpg","description"=>"Volets roulants manuels et électriques","parent_id"=>null,"slug"=>"volets-roulants","sort_order"=>1,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-27 23:53:23"],
            ["id"=>1,"title"=>"Menuiserie Battante","image"=>"images/categories/68c5fd888a6ac.png","description"=>"Fenêtres et portes battantes en aluminium","parent_id"=>null,"slug"=>"menuiserie-battante","sort_order"=>2,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-13 23:26:00"],
            ["id"=>2,"title"=>"Menuiserie Coulissante","image"=>"images/categories/68c5fda270427.png","description"=>"Fenêtres et portes coulissantes en aluminium","parent_id"=>null,"slug"=>"menuiserie-coulissante","sort_order"=>3,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-13 23:26:26"],
            ["id"=>8,"title"=>"Moustiquaire en aluminium","image"=>"images/categories/68c5fe2de5742.png","description"=>"Moustiquaires en aluminium de qualité","parent_id"=>null,"slug"=>"moustiquaire-en-aluminium","sort_order"=>4,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-13 23:28:45"],
            ["id"=>3,"title"=>"Façades Continues","image"=>"images/categories/68c5fdc9ecac7.png","description"=>"Façades continues et murs rideaux","parent_id"=>null,"slug"=>"facades-continues","sort_order"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-13 23:27:05"],
            ["id"=>6,"title"=>"Cloison Agencement","image"=>"images/categories/6889f4730e91b.jpg","description"=>"Cloisons vitrées et aménagements","parent_id"=>null,"slug"=>"cloison-agencement","sort_order"=>6,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-27 23:54:08"],
            ["id"=>5,"title"=>"Brises Soleil","image"=>"images/categories/6889f46226a6b.jpg","description"=>"Brises soleil horizontaux et verticaux","parent_id"=>null,"slug"=>"brises-soleil","sort_order"=>7,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-27 23:54:16"],
            ["id"=>9,"title"=>"Pergola en aluminium","image"=>"images/categories/68c5fe4b60bb5.png","description"=>"Pergolas en aluminium pour terrasses","parent_id"=>null,"slug"=>"pergola-en-aluminium","sort_order"=>8,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-13 23:29:15"],
            ["id"=>7,"title"=>"Garde-Corps","image"=>"images/categories/68c5fe09e68fe.png","description"=>"Garde-corps","parent_id"=>null,"slug"=>"garde-corps","sort_order"=>9,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-13 23:28:09"],
        ]);

        // Users (updated with co-admin roles)
        DB::table('users')->insert([
            ["id"=>1,"name"=>"Admin","email"=>"admin@gmail.com","email_verified_at"=>null,"password"=>"$2y$10$hvFL2kkD9BtZnqYlyMUaZOfSrKspNA3RNvxYxjgBrtJE/1xX9/Xny","photo"=>null,"role"=>"admin","provider"=>null,"provider_id"=>null,"status"=>"active","remember_token"=>null,"created_at"=>null,"updated_at"=>null],
            ["id"=>2,"name"=>"User","email"=>"user@gmail.com","email_verified_at"=>null,"password"=>"$2y$10$yO//SVcfidrRsd80IAEi0uAWYvpcjxT1n.ZACcL4caQszQkScuL9G","photo"=>null,"role"=>"co-admin","provider"=>null,"provider_id"=>null,"status"=>"active","remember_token"=>null,"created_at"=>null,"updated_at"=>null],
            ["id"=>3,"name"=>"testco","email"=>"test@gmail.com","email_verified_at"=>null,"password"=>"$2y$10$yO//SVcfidrRsd80IAEi0uAWYvpcjxT1n.ZACcL4caQszQkScuL9G","photo"=>null,"role"=>"co-admin","provider"=>null,"provider_id"=>null,"status"=>"active","remember_token"=>null,"created_at"=>null,"updated_at"=>null],
        ]);

        // Settings (updated structure)
        DB::table('settings')->insert([
            ["id"=>1,"short_des"=>"Aluminium sur mesure, qualité et innovation pour vos projets architecturaux.","hero_slogan"=>"LE MONDE SE REFLETE DANS NOS CREATIONS","presentation_image"=>"images/image3.png","address"=>"Route gremda km8, Sfax, TUNISIE","phone"=>"+216 58 844 717","email"=>"anis.fakhfakh@yahoo.fr","facebook"=>null,"warranty_years"=>10,"experience_years"=>15,"projects_count"=>378,"created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-09-13 23:45:00"],
        ]);

        // Certificates
        DB::table('certificates')->insert([
            ["id"=>1,"title"=>"Certificat d'Agrément – Profilés Aluminium (Tunisie)","image"=>"images/certificates/68bb6e75aaa1f.png","description"=>"Ce certificat atteste que nos profilés aluminium respectent les normes tunisiennes les plus strictes en matière de qualité, de durabilité et de sécurité. Il est délivré par les autorités compétentes et garantit la conformité de nos produits pour tous vos projets architecturaux en Tunisie.","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>2,"title"=>"Certificat de Conformité – Export Europe","image"=>"images/certificates/68bb6e75ae398.png","description"=>"Ce certificat valide la conformité de nos profilés aluminium aux exigences européennes (CE), permettant leur exportation et leur utilisation sur l'ensemble du marché européen. Il témoigne de notre engagement envers l'excellence et l'innovation à l'international.","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
        ]);

        // Project Categories
        DB::table('project_categories')->insert([
            ["id"=>1,"name"=>"Hôtels","image"=>"images/project-categories/688ba4d240dee.jpg","description"=>"Hôtels & Résidences","slug"=>"hotels","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>2,"name"=>"Bâtiments Industriels","image"=>"images/project-categories/688c7e39ee5b9.jpeg","description"=>"Bâtiments Industriels","slug"=>"batiments-industriels","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>4,"name"=>"Bureaux & Locaux Commerciaux","image"=>"images/project-categories/688ba8a74dd2c.jpeg","description"=>"Bureaux & Locaux Commerciaux","slug"=>"bureaux-locaux-commerciaux","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>5,"name"=>"Villas & Résidences Particulières","image"=>"images/project-categories/688ba93f71caa.jpeg","description"=>"Villas & Résidences Particulières","slug"=>"villas-residences-particulieres","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>6,"name"=>"Restaurants & cafés","image"=>"images/project-categories/688dc76ac1de1.jpeg","description"=>"Restaurants & cafés","slug"=>"restaurants-cafes","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
        ]);

        // Post Categories
        DB::table('post_categories')->insert([
            ["id"=>1,"name"=>"Actualités","slug"=>"actualites","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>2,"name"=>"Innovation","slug"=>"innovation","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>3,"name"=>"Projets","slug"=>"projets","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>4,"name"=>"Développement Durable","slug"=>"developpement-durable","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>5,"name"=>"Architecture","slug"=>"architecture","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>6,"name"=>"Design","slug"=>"design","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>7,"name"=>"Sécurité","slug"=>"securite","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
        ]);

        // Post Tags
        DB::table('post_tags')->insert([
            ["id"=>1,"name"=>"Aluminium","slug"=>"aluminium","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>2,"name"=>"Innovation","slug"=>"innovation","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>3,"name"=>"Durabilité","slug"=>"durabilite","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>4,"name"=>"Architecture","slug"=>"architecture","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>5,"name"=>"Construction","slug"=>"construction","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>6,"name"=>"Énergie","slug"=>"energie","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>7,"name"=>"Recyclage","slug"=>"recyclage","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>8,"name"=>"Design","slug"=>"design","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>9,"name"=>"Sécurité","slug"=>"securite","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>10,"name"=>"Technologie","slug"=>"technologie","status"=>"active","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
        ]);

        // Posts/Media (9 videos with SOTUMA title and empty summaries)
        DB::table('posts')->insert([
            ["id"=>14,"title"=>"SOTUMA","slug"=>"sotuma-14","summary"=>null,"description"=>"","quote"=>"","tags"=>"","post_cat_id"=>1,"post_tag_id"=>1,"added_by"=>1,"status"=>"active","views"=>0,"created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>16,"title"=>"SOTUMA","slug"=>"sotuma-16","summary"=>null,"description"=>"","quote"=>"","tags"=>"","post_cat_id"=>1,"post_tag_id"=>1,"added_by"=>1,"status"=>"active","views"=>0,"created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>17,"title"=>"SOTUMA","slug"=>"sotuma-17","summary"=>null,"description"=>"","quote"=>"","tags"=>"","post_cat_id"=>1,"post_tag_id"=>1,"added_by"=>1,"status"=>"active","views"=>0,"created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>18,"title"=>"SOTUMA","slug"=>"sotuma-18","summary"=>null,"description"=>"","quote"=>"","tags"=>"","post_cat_id"=>1,"post_tag_id"=>1,"added_by"=>1,"status"=>"active","views"=>0,"created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>20,"title"=>"SOTUMA","slug"=>"sotuma-20","summary"=>null,"description"=>"","quote"=>"","tags"=>"","post_cat_id"=>1,"post_tag_id"=>1,"added_by"=>1,"status"=>"active","views"=>0,"created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>21,"title"=>"SOTUMA","slug"=>"sotuma-21","summary"=>null,"description"=>"","quote"=>"","tags"=>"","post_cat_id"=>1,"post_tag_id"=>1,"added_by"=>1,"status"=>"active","views"=>0,"created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>22,"title"=>"SOTUMA","slug"=>"sotuma-22","summary"=>null,"description"=>"","quote"=>"","tags"=>"","post_cat_id"=>1,"post_tag_id"=>1,"added_by"=>1,"status"=>"active","views"=>0,"created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>23,"title"=>"SOTUMA","slug"=>"sotuma-23","summary"=>null,"description"=>"","quote"=>"","tags"=>"","post_cat_id"=>1,"post_tag_id"=>1,"added_by"=>1,"status"=>"active","views"=>0,"created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>24,"title"=>"SOTUMA","slug"=>"sotuma-24","summary"=>null,"description"=>"","quote"=>"","tags"=>"","post_cat_id"=>1,"post_tag_id"=>1,"added_by"=>1,"status"=>"active","views"=>0,"created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
        ]);

        // Post Images (Video files for the posts)
        DB::table('post_images')->insert([
            ["id"=>14,"post_id"=>14,"image"=>"images/blog/68bcc2e2a12da.mp4","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>15,"post_id"=>16,"image"=>"images/blog/68bcc30b57628.mp4","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>16,"post_id"=>17,"image"=>"images/blog/68bcc3215ce20.mp4","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>17,"post_id"=>18,"image"=>"images/blog/68bcc3315662b.mp4","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>19,"post_id"=>20,"image"=>"images/blog/68bcc361ccd3f.mp4","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>20,"post_id"=>20,"image"=>"images/blog/68bcc37cab229.mp4","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>21,"post_id"=>21,"image"=>"images/blog/68bcc3991f62a.mp4","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>22,"post_id"=>22,"image"=>"images/blog/68bcc3b444802.mp4","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>23,"post_id"=>23,"image"=>"images/blog/68bcc3f1132ab.mp4","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
            ["id"=>24,"post_id"=>24,"image"=>"images/blog/68bcc407f3842.mp4","created_at"=>"2025-08-08 21:52:00","updated_at"=>"2025-08-08 21:52:00"],
        ]);

        // Products (ALL 48 products with updated data and images)
        DB::table('products')->insert([
            ["id"=>2,"title"=>"SÉRIE Elipse TPR 40","has_details"=>1,"description"=>"•Dormant d'épaisseur 40 mm.
•Ouvrant d'épaisseur 47 mm.
•Double vitrage:
• 20mm parclose elliptique.
• 28mm parclose droite.
•Accessoires haut de gamme.
•Parclose elliptique à coupe d'onglet sans pièce d'angle.
•Joints d'étanchéité en EPDM d'excellente qualité.
•Étanchéité A.E renforcée.
•A*3 E*7B V*C3","specifications"=>null,"features"=>null,"slug"=>"elipse-tpr-40","image"=>"images/products/688b760e14ecb.jpg","category_id"=>1,"sort_order"=>0,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-06 23:56:38"],
            ["id"=>1,"title"=>"SÉRIE Prestige EX45","has_details"=>1,"description"=>"Dormant d’épaisseur 45 mm.
.Ouvrant d’épaisseur 53 mm.
.Double vitrage:
.24 mm parclose elliptique.
.32 mm parclose droite.
.Accessoires haut de gamme.
.Parclose elliptique à coupe d’onglet sans pièce d’angle.
.Joints d’étanchéité en EPDM d’excellente qualité.
.Étanchéité A.E renforcée.
.A*3 E*7B V*C3","specifications"=>null,"features"=>null,"slug"=>"prestige-ex45","image"=>"images/products/688b76cd319c7.jpg","category_id"=>1,"sort_order"=>1,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-06 23:56:38"],
            ["id"=>4,"title"=>"SÉRIE Confort TW60","has_details"=>1,"description"=>"Dormant d’épaisseur 60 mm.
Ouvrant d’épaisseur 68 mm.
Double vitrage:
34 mm parclose elliptique.
42 mm parclose droite.
Accessoires haut de gamme.
Parclose elliptique à coupe d’onglet sans pièce d’angle.
Joints d’étanchéité en EPDM d’excellente qualité.
Étanchéité A.E renforcée.
A*3 E*7B V*C3","specifications"=>null,"features"=>null,"slug"=>"confort-tw60","image"=>"images/products/688b7789a4110.jpg","category_id"=>1,"sort_order"=>2,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-06 23:56:38"],
            ["id"=>3,"title"=>"SÉRIE Blindee TPR 75","has_details"=>1,"description"=>"Dormant épaisseur 75 mm.
Ouvrant épaisseur 75 mm.
Epaisseur Alu 2 mm minimum.
Lames de blindage Alu ou Acier.
Crémone et serrures spéciales à fermeture multipoints.
Rotation sur paumelles en applique.
Joint en EPDM de haute qaulité
Assemblage dormant à 45°.
Assemblage ouvrant à 45°.
Vitrage jusqu’à 42mm.","specifications"=>null,"features"=>null,"slug"=>"blindee-tpr-75","image"=>"images/products/688b7629c178c.jpg","category_id"=>1,"sort_order"=>3,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-06 23:56:38"],
            ["id"=>6,"title"=>"SÉRIE Elipse 67","has_details"=>1,"description"=>"Dormant d’épaisseur 40 mm.
Ouvrant d’épaisseur 29 mm.
Simple vitrage: 6, 8 et 10 mm.
Double vitrage: 18 et 20 mm.
Accessoires haut de gamme.
Fermetures multipoints pré réglées avec gâches réglables.
Galets simples ou doubles réglables de 90 à 180kg.
Joints d’étanchéité en EPDM d’excellente qualité.
Doubles joints brosse fin-seal.
Étanchéité A.E renforcée.
A*3   E*7B   V*C3","specifications"=>null,"features"=>null,"slug"=>"elipse-67","image"=>"images/products/688b763b0288e.jpg","category_id"=>2,"sort_order"=>0,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-07 23:42:29"],
            ["id"=>5,"title"=>"SÉRIE Prestige EX60","has_details"=>1,"description"=>"Dormant d’épaisseur 60 mm.
Ouvrant d’épaisseur 34 mm.
Simple vitrage: 6, 8 et 10 mm.
Double vitrage: jusqu’à 26 mm.
Accessoires haut de gamme.
Fermetures multipoints pré réglées avec gâches réglables.
Galets simples ou doubles réglables de 90 à 180kg.
Double joints brosse fin seal.
Etanchéité A.E renforcée.
A*3   E*7B   V*C3","specifications"=>null,"features"=>null,"slug"=>"prestige-ex60","image"=>"images/products/688b76e38f22a.jpg","category_id"=>2,"sort_order"=>1,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-07 23:42:29"],
            ["id"=>35,"title"=>"SÉRIE EX60 PRESTIGE LIGNE ELLIPTIQUE","has_details"=>1,"description"=>"Dormant d’épaisseur 60 mm.
Ouvrant d’épaisseur 34 mm.
Simple vitrage: 6, 8 et 10 mm.
Double vitrage: jusqu’à 26 mm.
Accessoires haut de gamme.
Fermetures multipoints pré réglées avec gâches réglables.
Galets simples ou doubles réglables de 90 à 180kg.
Double joints brosse fin seal.
Etanchéité A.E renforcée.
A*3   E*7B   V*C3","specifications"=>null,"features"=>null,"slug"=>"serie-ex60-prestige-ligne-droite","image"=>"images/products/688b75e17c863.jpg","category_id"=>2,"sort_order"=>2,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-07 23:42:29"],
            ["id"=>34,"title"=>"SÉRIE EX60 PRESTIGE LIGNE DROITE","has_details"=>1,"description"=>"Dormant  d’épaisseur 60 mm.
Ouvrant d’épaisseur 34 mm.
Simple vitrage: 6, 8 et 10 mm.
Double vitrage: 20 et 26 mm.
Accessoires haut de gamme.
Fermetures multipoints pré réglées avec gâches réglables.
Galets simples ou doubles réglables de 90 à 180kg.
Double joints brosse fin seal.
Etanchéité A.E renforcée.
A*3   E*7B   V*C3","specifications"=>null,"features"=>null,"slug"=>"serie-ex60-prestige-ligne-elliptique","image"=>"images/products/688b754555431.jpg","category_id"=>2,"sort_order"=>3,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-07 23:42:29"],
            ["id"=>37,"title"=>"SÉRIE Confort TS60 Ligne Elliptique","has_details"=>1,"description"=>"Dormant d’épaisseur 60 mm.
Ouvrant d’épaisseur 34 mm.
Simple vitrage: 6, 8 et 10 mm.
Double vitrage: jusqu’à 26 mm.
Accessoires haut de gamme.
Fermetures multipoints pré réglées avec gâches réglables.
Galets simples ou doubles réglables de 90 à 180kg.
Doubles joints brosse fin-seal.
Étanchéité A.E renforcée.
A*3   E*7B   V*C3","specifications"=>null,"features"=>null,"slug"=>"serie-confort-ts60-ligne-elliptique","image"=>"images/products/68be1821b7f74.png","category_id"=>2,"sort_order"=>4,"created_at"=>"2025-09-07 23:41:21","updated_at"=>"2025-09-07 23:42:29"],
            ["id"=>7,"title"=>"SÉRIE Confort TS60 Ligne Droite","has_details"=>1,"description"=>"Dormant d’épaisseur 60 mm.
Ouvrant d’épaisseur 34 mm.
Simple vitrage: 6, 8 et 10 mm.
Double vitrage: jusqu’à 26 mm.
Accessoires haut de gamme.
Fermetures multipoints pré réglées avec gâches réglables.
Galets simples ou doubles réglables de 90 à 180kg.
Doubles joints brosse fin-seal.
Étanchéité A.E renforcée.
A*3   E*7B   V*C3","specifications"=>null,"features"=>null,"slug"=>"confort-ts60","image"=>"images/products/688b764d6d642.jpg","category_id"=>2,"sort_order"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-07 23:42:29"],
            ["id"=>36,"title"=>"SERIE 130 CONFORT","has_details"=>1,"description"=>"Coulissant à Levage pour Portes Fenêtres à Rupture de Pont Thermique

Grandes Dimensions avec une hauteur jusqu’à 3,5m et un poids jusqu’à 400kg.

Dormants à 2 rails à coupe d’onglet d’épaisseur 160 x 56 mm avec un chemin de roulement en inox.
Ouvrants à coupe d’onglet d’épaisseur 70 x 103 mm.
Parcloses droites pour double ou triple vitrage jusqu’à 52 mm.
Fermeture multipoints de 2 à 5 points actionnées par une poignet spécifique simple ou double.
Roulettes à levage de grande charge jusqu’à 400kg.
Joints de vitrage en EPDM d’excellente qualité.
Etanchéité par double joints en EPDM ou brosse fin seal.","specifications"=>null,"features"=>null,"slug"=>"serie-130-confort","image"=>"images/products/68be139172841.jpg","category_id"=>2,"sort_order"=>6,"created_at"=>"2025-09-07 23:21:53","updated_at"=>"2025-09-07 23:43:52"],
            ["id"=>8,"title"=>"SÉRIE Confort 160","has_details"=>1,"description"=>"Dormant d’épaisseur 60 mm.
Ouvrant d’épaisseur 34 mm.
Simple vitrage: 6, 8 et 10 mm.
Double vitrage: jusqu’à 26 mm.
Accessoires haut de gamme.
Fermetures multipoints pré réglées avec gâches réglables.
Galets simples ou doubles réglables de 90 à 180kg.
Doubles joints brosse fin-seal.
Étanchéité A.E renforcée.
A*3   E*7B   V*C3","specifications"=>null,"features"=>null,"slug"=>"confort-160","image"=>"images/products/688b77955f450.jpg","category_id"=>2,"sort_order"=>7,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-07 23:42:29"],
            ["id"=>10,"title"=>"Verre extérieur parclosé VEP","has_details"=>1,"description"=>"Système de Façade Rideau à Rupture de Pont Thermique VEP

Structure constituée de meneaux verticaux et de traverses horizontales de meme section et de largeur intérieure visible de 52 mm.
Panneaux de remplissage “visions ou opaques” en profilé multi-chambre à rupture de pont thermique assemblés par une double équerre à sertir en aluminium et étanchés par une colle spéciale.
Assemblage des traverses sur meneaux assuré par des blocs spéciaux en aluminium et des bouchons de finition élastique absorbant les effets de dilatation des traverses.
Panneaux fixes reposant sur des cales “supports panneaux” et tenus à l’ossature par des blocs à pions de qualité sur les côtés latéraux du cadre.
Double vitrage en panneaux vision de 24 à 28 mm d’épaisseur et d’un poids maxi de 130kg.
Visserie et boulonnerie entièrement en acier inoxydable anti-corrosion.","specifications"=>null,"features"=>null,"slug"=>"verre-exterieur-parclose-vep","image"=>"images/products/688b77fc99eb7.png","category_id"=>3,"sort_order"=>0,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 21:19:13"],
            ["id"=>9,"title"=>"Verre extérieur collé VEC","has_details"=>1,"description"=>"Système de Façade Rideau à Rupture de Pont Thermique
Façade à Vitrage Extérieur Collé (VEC)
Structure constituée de meneaux verticaux et de traverses horizontales de même section et de largeur intérieure visible de 52mm.
Panneaux de remplissage “visions ou opaques” en profilé multi chambre à rupture de pont thermique assemblés par une double équerre à sertir en aluminium et étanchés par une colle spéciale.
Assemblage des traverses sur meneaux assuré par des blocs spéciaux en aluminium et des bouchons de finition élastique absorbant les effets de dilatation des traverses.
Panneaux fixes reposant sur des cales “supports panneaux” et tenus à l’ossature par des blocs à pions de qualité sur les côtés latéraux du cadre.
Double vitrage en panneaux vision de 24 à 36mm d’épaisseur et d’un poids maxi de 130kg.
Visserie et boulonnerie entièrement en acier inoxydable anti-corrosion.","specifications"=>null,"features"=>null,"slug"=>"verre-exterieur-colle-vec","image"=>"images/products/68afa22796f34.png","category_id"=>3,"sort_order"=>1,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 21:18:15"],
            ["id"=>12,"title"=>"Façades Traditionelle TRD","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"facades-traditionelle-trd","image"=>"images/products/688ba12e75ac9.png","category_id"=>3,"sort_order"=>2,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 20:40:00"],
            ["id"=>13,"title"=>"Façades a Trame Horizontal","has_details"=>1,"description"=>"Système de Façade Rideau à Rupture de Pont Thermique
Facade à Trame Horizontale (TH)
Structure constituée de meneaux verticaux et de traverses horizontales de même section et de largeur intérieure visible de 52mm.
Isolation thermique assurée par un joint sur les meneaux et par des écarteurs en polyamide placés aux nez des traverses.
Remplissages “vision ou opaques” tenus à l’ossature par un profil “serreur vissé” directement au nez des traverses.
Aspect extérieur de la façade finalisé par des joints verticaux et des capots horizontaux de différentes formes et de largeur visible de 52mm.
Panneaux ouvrants de type VEC constitués par des profils dormants et des ouvrants à rupture de pont thermique et assemblés par une double équerre à sertir en Aluminium.
Joints extérieurs et intérieurs en EPDM qui assurent l’étanchéité à l’air et à l’eau.
Drainage en cascade sur les deux niveaux qui assure une meilleure étanchéité à l’air et à l’eau.","specifications"=>null,"features"=>null,"slug"=>"facades-a-trame-horizontal","image"=>"images/products/6889f896de08a.png","category_id"=>3,"sort_order"=>3,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 21:20:19"],
            ["id"=>14,"title"=>"VR PVC","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"vr-pvc","image"=>"images/products/6889f8bfa422c.jpg","category_id"=>4,"sort_order"=>0,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 00:39:48"],
            ["id"=>38,"title"=>"Lame Injectée","has_details"=>1,"description"=>"– Lames injectées : isolation thermique et acoustique grâce à un noyau en mousse polyuréthane, légères et faciles à manipuler.
– Lames extrudées : haute résistance et longévité, idéales pour les environnements exigeants.

Les deux solutions offrent une esthétique soignée et une installation facile.

Caractéristiques principales :
– Excellente isolation (injectées) ou robustesse maximale (extrudées)
– Design épuré et contemporain
– Finitions personnalisables
– Résistance aux intempéries
– Fonctionnement durable et fluide","specifications"=>null,"features"=>null,"slug"=>"lame-injectee","image"=>"images/products/68be1c10ac15f.jpg","category_id"=>4,"sort_order"=>1,"created_at"=>"2025-09-07 23:58:08","updated_at"=>"2025-09-08 00:39:48"],
            ["id"=>19,"title"=>"VR avec Trou et Plexiglass","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"vr-avec-trou-et-plexiglass","image"=>"images/products/68be218a4612c.jpeg","category_id"=>4,"sort_order"=>2,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 00:39:48"],
            ["id"=>16,"title"=>"VR Transmission par Chaine","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"vr-transmission-par-chaine","image"=>"images/products/68be2152a7492.jpg","category_id"=>4,"sort_order"=>3,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 00:39:48"],
            ["id"=>39,"title"=>"Lame Perforée","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"lame-perforee","image"=>"images/products/68be2024a6cf5.jpg","category_id"=>4,"sort_order"=>4,"created_at"=>"2025-09-08 00:15:32","updated_at"=>"2025-09-08 00:39:48"],
            ["id"=>15,"title"=>"VR avec Fonte","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"vr-avec-fonte","image"=>"images/products/68be20744c9da.jpg","category_id"=>4,"sort_order"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 00:39:48"],
            ["id"=>17,"title"=>"VR Plat Moustiquaire","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"vr-plat-moustiquaire","image"=>"images/products/68be22691201d.jpg","category_id"=>4,"sort_order"=>6,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 00:39:48"],
            ["id"=>18,"title"=>"VR Fonte Moustiquaire","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"vr-fonte-moustiquaire","image"=>"images/products/68be20af59374.jpg","category_id"=>4,"sort_order"=>7,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 00:39:48"],
            ["id"=>40,"title"=>"Lame Plat","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"lame-plat","image"=>"images/products/68be20f7d40aa.jpg","category_id"=>4,"sort_order"=>8,"created_at"=>"2025-09-08 00:19:03","updated_at"=>"2025-09-08 00:39:48"],
            ["id"=>42,"title"=>"Lame Acier Injectée","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"lame-acier-injectee","image"=>"images/products/68be2585b0af0.jpg","category_id"=>4,"sort_order"=>9,"created_at"=>"2025-09-08 00:38:29","updated_at"=>"2025-09-08 00:39:48"],
            ["id"=>41,"title"=>"Lame orientable","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"lame-orientable","image"=>"images/products/68be24fd6d617.jpg","category_id"=>4,"sort_order"=>10,"created_at"=>"2025-09-08 00:36:13","updated_at"=>"2025-09-08 00:39:48"],
            ["id"=>21,"title"=>"Brise Soleil Filante en Z","has_details"=>1,"description"=>"Supports Flasques d’extrémités en tôle d’aluminium pour des lames fixes selon les différentes orientations proposées (0, 15, 30 ou 45°).
Support Fourche intermédiaire en aluminium pour des lames filantes permettant de choisir parmi les différentes orientations proposées (0, 15, 30 ou 45°).
Supports Flasques d’extrémités en tôle d’aluminium pour des lames mobiles motorisées.
Supports des lames fixés directement sur la construction ou sur des Profils porteurs en aluminium.
Régulation solaire et lumineuse.
Protection contre le vent et la pluie.
Ventilation et aération.
Occultation visuelle partielle.","specifications"=>null,"features"=>null,"slug"=>"brise-soleil-filante-en-z","image"=>"images/products/688b774dd092e.jpg","category_id"=>5,"sort_order"=>0,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 20:58:58"],
            ["id"=>20,"title"=>"Brises Soleil","has_details"=>1,"description"=>"Lames en profilés aluminium extrudés de forme rectangulaire ou en aile d’avion en plusieurs dimensions.
Lames rectangulaires de 140 à 300 mm de largeur.
Lames en aile d’avion de 210 à 400 mm de largeur.
Supports Flasques d’extrémités en tôle d’aluminium pour des lames fixes selon les différentes orientations proposées (0, 15, 30 ou 45°).
Support Fourche intermédiaire en aluminium pour des lames filantes permettant de choisir parmi les différentes orientations proposées (0, 15, 30 ou 45°).
Supports Flasques d’extrémités en tôle d’aluminium pour des lames mobiles motorisées.
Supports des lames fixés directement sur la construction ou sur des Profils porteurs en aluminium.
Brise Soleil à lames mobiles montées entre poteaux et maintenues par des flasques solidaires d’un vérin électrique.
Brises Soleil TPR BS installés horizontalement ou verticalement, en façade, en casquette ou en tableau.
Régulation solaire et lumineuse.
Protection contre le vent et la pluie.
Ventilation et aération.
Occultation visuelle partielle.","specifications"=>null,"features"=>null,"slug"=>"brises-soleil-rectangulaire-et-elliptique","image"=>"images/products/688b7767a8b1d.jpg","category_id"=>5,"sort_order"=>0,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 20:53:28"],
            ["id"=>51,"title"=>"Brises Soleil Rectangulaire et Elliptique","has_details"=>1,"description"=>"Lames en profilés aluminium extrudés de forme rectangulaire ou en aile d’avion en plusieurs dimensions.
Lames rectangulaires de 140 à 300 mm de largeur.
Lames en aile d’avion de 210 à 400 mm de largeur.
Supports Flasques d’extrémités en tôle d’aluminium pour des lames fixes selon les différentes orientations proposées (0, 15, 30 ou 45°).
Support Fourche intermédiaire en aluminium pour des lames filantes permettant de choisir parmi les différentes orientations proposées (0, 15, 30 ou 45°).
Supports Flasques d’extrémités en tôle d’aluminium pour des lames mobiles motorisées.
Supports des lames fixés directement sur la construction ou sur des Profils porteurs en aluminium.
Brise Soleil à lames mobiles montées entre poteaux et maintenues par des flasques solidaires d’un vérin électrique.
Brises Soleil TPR BS installés horizontalement ou verticalement, en façade, en casquette ou en tableau.
Régulation solaire et lumineuse.
Protection contre le vent et la pluie.
Ventilation et aération.
Occultation visuelle partielle.","specifications"=>null,"features"=>null,"slug"=>"brises-soleil-rectangulaire-et-elliptique","image"=>"images/products/68bf417a30ef2.jpg","category_id"=>5,"sort_order"=>0,"created_at"=>"2025-09-08 20:50:02","updated_at"=>"2025-09-08 20:57:39"],
            ["id"=>43,"title"=>"Cloisons lisses structure visible","has_details"=>1,"description"=>"Épaisseur de 75 mm.
Largeur aluminium de 40 mm.
Profilé de structure assemblé à 90°.
Vitrage de 4 à 8 mm en double parois.
Vide entre vitrage de 58 mm.
Panneau plein en double paroi de 10 à 13 mm.
Isolant entre panneau de 50 mm.
Cache parclose clippage.","specifications"=>null,"features"=>null,"slug"=>"cloisons-lisses-structure-visible","image"=>"images/products/68be26ac8e2bc.jpg","category_id"=>6,"sort_order"=>0,"created_at"=>"2025-09-08 00:43:24","updated_at"=>"2025-09-08 00:43:24"],
            ["id"=>44,"title"=>"Cloisons lisses à joint creux","has_details"=>1,"description"=>"Epaisseur : 82mm
Profilé de structure assemblé à 90°
Vitrage de 5mm en double parois
Vide entre vitrage de 58mm
Panneau plein en double parois de 16mm
Isolant entre panneau de 50mm
Joint creux entre panneaux en bois de 5mm","specifications"=>null,"features"=>null,"slug"=>"cloisons-lisses-a-joint-creux","image"=>"images/products/68be2702a8420.jpg","category_id"=>6,"sort_order"=>0,"created_at"=>"2025-09-08 00:44:50","updated_at"=>"2025-09-08 00:44:50"],
            ["id"=>53,"title"=>"Garde Corps En Verre","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"garde-corps-en-verre","image"=>"images/products/68bf4b7405d19.jpg","category_id"=>7,"sort_order"=>0,"created_at"=>"2025-09-08 21:32:36","updated_at"=>"2025-09-08 21:39:27"],
            ["id"=>54,"title"=>"Garde corps en aluminium et verre","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"garde-corps-en-aluminium-et-verre","image"=>"images/products/68bf4bffcfc65.jpg","category_id"=>7,"sort_order"=>1,"created_at"=>"2025-09-08 21:34:55","updated_at"=>"2025-09-08 21:39:27"],
            ["id"=>55,"title"=>"Garde Corps Barreaux","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"garde-corps-barreaux","image"=>"images/products/68bf4c8fb39e0.jpg","category_id"=>7,"sort_order"=>2,"created_at"=>"2025-09-08 21:37:19","updated_at"=>"2025-09-08 21:39:27"],
            ["id"=>28,"title"=>"Garde-Corps Vitrages avec distancer","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"garde-corps-vitrages-avec-distancer","image"=>"images/products/6889fb19538e1.jpg","category_id"=>7,"sort_order"=>3,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 21:39:27"],
            ["id"=>45,"title"=>"Moustiquaire plisée","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"moustiquaire-plisee","image"=>"images/products/68bf396ad5867.jpg","category_id"=>8,"sort_order"=>0,"created_at"=>"2025-09-08 20:15:38","updated_at"=>"2025-09-08 20:34:57"],
            ["id"=>46,"title"=>"Moustiquaire plisée","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"moustiquaire-plisee","image"=>"images/products/68bf39ec5cc4e.jpg","category_id"=>8,"sort_order"=>1,"created_at"=>"2025-09-08 20:17:48","updated_at"=>"2025-09-08 20:34:57"],
            ["id"=>25,"title"=>"Moustiquaire plisée","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"moustiquaire-plisee","image"=>"images/products/688b793700db4.jpg","category_id"=>8,"sort_order"=>2,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 20:34:57"],
            ["id"=>47,"title"=>"Système Coulissante","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"systeme-coulissante","image"=>"images/products/68bf3ade36322.jpg","category_id"=>8,"sort_order"=>3,"created_at"=>"2025-09-08 20:21:50","updated_at"=>"2025-09-08 20:34:57"],
            ["id"=>22,"title"=>"Moustiquaire enroulable","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"moustiquaire-enroulable","image"=>"images/products/68bf3c4a4a9af.jpg","category_id"=>8,"sort_order"=>4,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 20:34:57"],
            ["id"=>50,"title"=>"Moustiquaire enroulable","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"moustiquaire-enroulable","image"=>"images/products/68bf3c642db93.jpg","category_id"=>8,"sort_order"=>5,"created_at"=>"2025-09-08 20:28:20","updated_at"=>"2025-09-08 20:34:57"],
            ["id"=>49,"title"=>"Système A Cadre Fixe","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"systeme-a-cadre-fixe","image"=>"images/products/68bf3b922865b.jpg","category_id"=>8,"sort_order"=>6,"created_at"=>"2025-09-08 20:24:50","updated_at"=>"2025-09-08 20:34:57"],
            ["id"=>48,"title"=>"Système A Cadre Fixe","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"systeme-a-cadre-fixe","image"=>"images/products/68bf3b47d4033.jpg","category_id"=>8,"sort_order"=>7,"created_at"=>"2025-09-08 20:23:35","updated_at"=>"2025-09-08 20:34:57"],
            ["id"=>23,"title"=>"Moustiquaire latéral simple","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"moustiquaire-lateral-simple","image"=>"images/products/688b77c64740c.jpg","category_id"=>8,"sort_order"=>8,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 20:34:57"],
            ["id"=>24,"title"=>"Moustiquaire latéral double","has_details"=>0,"description"=>null,"specifications"=>null,"features"=>null,"slug"=>"moustiquaire-lateral-double","image"=>"images/products/688b77b31e40e.jpg","category_id"=>8,"sort_order"=>9,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 20:34:57"],
            ["id"=>32,"title"=>"Pergola en aluminium","has_details"=>1,"description"=>"Avec sa structure en aluminium extrudé spécialement étudiée pour les espaces extérieurs, ses lames orientables et sa motorisation pour une ouverture pas à pas, elle permet de profiter de sa véranda, quelle que soit la météo.

CARACTÉRISTIQUES TECHNIQUES

Lames orientables en aluminium extrudées de 190X34mm ep 2mm, équipées de joints en EPDM, permettant une parfaite étanchéité.
Traverses latérales de 125X230mm ep 3mm (coupe droite 90°).
Système de drainage d’eau intégré dans le poteau de la pergola.
Poteaux carrés de 130X130 mm (coupe droite 90° et facile à l’assemblage).
Accessoires inoxydables et bouchons en Inox.
Motorisation radio (ouverture pas à pas) avec télécommande équipée de détecteurs de vent.","specifications"=>null,"features"=>null,"slug"=>"pergola-en-aluminium","image"=>"images/products/68bf4605bbcfe.jpg","category_id"=>9,"sort_order"=>0,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-09-08 21:10:51"],
            ["id"=>52,"title"=>"Pergola Aluminium","has_details"=>1,"description"=>"Avec sa structure en aluminium extrudé spécialement étudiée pour les espaces extérieurs, ses lames orientables et sa motorisation pour une ouverture pas à pas, elle permet de profiter de sa véranda, quelle que soit la météo.

CARACTÉRISTIQUES TECHNIQUES

Lames orientables en aluminium extrudées de 190X34mm ep 2mm, équipées de joints en EPDM, permettant une parfaite étanchéité.
Traverses latérales de 125X230mm ep 3mm (coupe droite 90°).
Système de drainage d’eau intégré dans le poteau de la pergola.
Poteaux carrés de 130X130 mm (coupe droite 90° et facile à l’assemblage).
Accessoires inoxydables et bouchons en Inox.
Motorisation radio (ouverture pas à pas) avec télécommande équipée de détecteurs de vent.","specifications"=>null,"features"=>null,"slug"=>"pergola-aluminium","image"=>"images/products/68bf47e5ef9bd.jpg","category_id"=>9,"sort_order"=>0,"created_at"=>"2025-09-08 21:17:25","updated_at"=>"2025-09-08 21:17:25"],
        ]);

        // Projects (ALL 25 projects with complete data)
        DB::table('projects')->insert([
            ["id"=>4,"title"=>"Assurance ASTREE","description"=>"Assurance ASTREE","image"=>"images/projects/688cd347a7111.jpeg","project_category_id"=>4,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>5,"title"=>"Villa","description"=>"Villa","image"=>"images/projects/688cd3f170d13.jpeg","project_category_id"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>6,"title"=>"Villa","description"=>"Villa","image"=>"images/projects/688cd48547e46.jpeg","project_category_id"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>7,"title"=>"Hôtel la Villa Bleu","description"=>"Hôtel la villa bleu","image"=>"images/projects/688cd54215290.jpeg","project_category_id"=>1,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>8,"title"=>"Villa","description"=>"Villa","image"=>"images/projects/688dd20e50f21.jpg","project_category_id"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>9,"title"=>"Villa","description"=>"Villa","image"=>"images/projects/688dd313b5932.jpg","project_category_id"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>10,"title"=>"Villa","description"=>"Villa","image"=>"images/projects/688dd4163dc48.jpg","project_category_id"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>11,"title"=>"Villa","description"=>"Villa","image"=>"images/projects/688dd4695fdaf.jpg","project_category_id"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>13,"title"=>"Hotel Le Sultan","description"=>"Hotel Le Sultan","image"=>"images/projects/688dd7dc5bb28.jpg","project_category_id"=>1,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-25 13:14:21"],
            ["id"=>14,"title"=>"CPR Auto","description"=>"CPR Auto","image"=>"images/projects/688dd8a1a91c9.jpg","project_category_id"=>4,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>15,"title"=>"Peugeot Sfax","description"=>"Peugeot Sfax","image"=>"images/projects/688dd928e27df.jpg","project_category_id"=>4,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>16,"title"=>"Immeuble Jalouli Sfax","description"=>"Immeuble Jalouli Sfax","image"=>"images/projects/688dd9b8d8378.jpg","project_category_id"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>17,"title"=>"Immeuble Rourou","description"=>"Immeuble Rourou","image"=>"images/projects/688ddc86adfff.jpg","project_category_id"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>18,"title"=>"Villa","description"=>"Villa","image"=>"images/projects/688ddcdf05671.jpg","project_category_id"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>19,"title"=>"APT","description"=>"APT","image"=>"images/projects/688ddd9245108.jpg","project_category_id"=>4,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>20,"title"=>"Villa","description"=>"Villa","image"=>"images/projects/688dddbccb1ad.jpg","project_category_id"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>21,"title"=>"Ste Chaaben Frères Beton","description"=>"Ste Chaaben Frères Beton","image"=>"images/projects/688dde4f2dc92.jpg","project_category_id"=>4,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>22,"title"=>"CPR Auto","description"=>"CPR Auto","image"=>"images/projects/688de0c95b338.jpg","project_category_id"=>4,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>23,"title"=>"Villa","description"=>"Villa","image"=>"images/projects/688de0fc2de00.jpg","project_category_id"=>5,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>24,"title"=>"PROMOTOS","description"=>"PROMOTOS","image"=>"images/projects/688de25ecb052.jpg","project_category_id"=>4,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>25,"title"=>"Ste Softy","description"=>"Ste Softy","image"=>"images/projects/688de22344cd3.jpg","project_category_id"=>2,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>26,"title"=>"FAKHFAKH Aslam Jewlery","description"=>"FAKHFAKH Aslam Jewlery","image"=>"images/projects/688de47d6c388.png","project_category_id"=>4,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>27,"title"=>"A Table","description"=>"A Table","image"=>"images/projects/688de4d7b7fe7.jpg","project_category_id"=>6,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>28,"title"=>"Restaurant Le GOLFE","description"=>"Restaurant Le GOLFE","image"=>"images/projects/688de5370acf2.jpg","project_category_id"=>6,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>29,"title"=>"Café Restaurant Moving Club","description"=>"Moving Club","image"=>"images/projects/688de65093ca6.jpg","project_category_id"=>6,"created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
        ]);

        // Project Images (ALL 100 project images)
        DB::table('project_images')->insert([
            ["id"=>1,"project_id"=>4,"image"=>"images/projects/688cd347a7111.jpeg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>2,"project_id"=>4,"image"=>"images/projects/688cd347ab428.jpeg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>3,"project_id"=>14,"image"=>"images/projects/688dd8a1a91c9.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>4,"project_id"=>14,"image"=>"images/projects/688dd8a1ab5a2.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>5,"project_id"=>15,"image"=>"images/projects/688dd928e27df.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>6,"project_id"=>15,"image"=>"images/projects/688dd928e6432.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>7,"project_id"=>19,"image"=>"images/projects/688ddd9245108.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>8,"project_id"=>19,"image"=>"images/projects/688ddd92481c9.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>9,"project_id"=>19,"image"=>"images/projects/688ddd9249284.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>10,"project_id"=>19,"image"=>"images/projects/688ddd924a378.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>11,"project_id"=>19,"image"=>"images/projects/688ddd924b35e.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>12,"project_id"=>19,"image"=>"images/projects/688ddd924c7ee.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>13,"project_id"=>21,"image"=>"images/projects/688dde4f2dc92.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>14,"project_id"=>21,"image"=>"images/projects/688dde4f2f8f7.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>15,"project_id"=>21,"image"=>"images/projects/688dde4f30c96.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>16,"project_id"=>21,"image"=>"images/projects/688dde4f32107.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>17,"project_id"=>22,"image"=>"images/projects/688de0c952b66.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>18,"project_id"=>22,"image"=>"images/projects/688de0c95b338.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>19,"project_id"=>22,"image"=>"images/projects/688de0c96883f.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>20,"project_id"=>22,"image"=>"images/projects/688de0c96b54f.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>21,"project_id"=>22,"image"=>"images/projects/688de0c970854.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>22,"project_id"=>22,"image"=>"images/projects/688de0c97233f.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>23,"project_id"=>24,"image"=>"images/projects/688de1ac3475c.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>24,"project_id"=>24,"image"=>"images/projects/688de1ac36db8.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>25,"project_id"=>24,"image"=>"images/projects/688de1ac37e54.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>26,"project_id"=>24,"image"=>"images/projects/688de1ac39401.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>27,"project_id"=>24,"image"=>"images/projects/688de1ac3a85e.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>28,"project_id"=>24,"image"=>"images/projects/688de25ecb052.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>29,"project_id"=>24,"image"=>"images/projects/688de25ecd359.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>30,"project_id"=>26,"image"=>"images/projects/688de47d6c388.png","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>31,"project_id"=>5,"image"=>"images/projects/688cd3f170d13.jpeg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>32,"project_id"=>5,"image"=>"images/projects/688cd3f173b89.jpeg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>33,"project_id"=>5,"image"=>"images/projects/688cd3f17550c.jpeg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>34,"project_id"=>6,"image"=>"images/projects/688cd48547e46.jpeg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>35,"project_id"=>6,"image"=>"images/projects/688cd4854a956.jpeg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>36,"project_id"=>6,"image"=>"images/projects/688cd4854ba0a.jpeg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>37,"project_id"=>6,"image"=>"images/projects/688cd4854cb40.jpeg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>38,"project_id"=>6,"image"=>"images/projects/688cd4854dc12.jpeg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>39,"project_id"=>6,"image"=>"images/projects/688cd4854ed64.jpeg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>40,"project_id"=>8,"image"=>"images/projects/688dd20e50f21.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>41,"project_id"=>8,"image"=>"images/projects/688dd20e5302d.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>42,"project_id"=>8,"image"=>"images/projects/688dd20e540a2.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>43,"project_id"=>8,"image"=>"images/projects/688dd20e55613.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>44,"project_id"=>8,"image"=>"images/projects/688dd20e56c17.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>45,"project_id"=>8,"image"=>"images/projects/688dd20e57c25.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>46,"project_id"=>8,"image"=>"images/projects/688dd20e58ad2.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>47,"project_id"=>8,"image"=>"images/projects/688dd20e59961.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>48,"project_id"=>8,"image"=>"images/projects/688dd20e5ac16.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>49,"project_id"=>8,"image"=>"images/projects/688dd20e5bdb8.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>50,"project_id"=>8,"image"=>"images/projects/688dd20e5cbb4.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>51,"project_id"=>9,"image"=>"images/projects/688dd313b5932.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>52,"project_id"=>9,"image"=>"images/projects/688dd313b91b2.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>53,"project_id"=>9,"image"=>"images/projects/688dd313bb8b6.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>54,"project_id"=>9,"image"=>"images/projects/688dd313be6c5.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>55,"project_id"=>9,"image"=>"images/projects/688dd313bfc48.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>56,"project_id"=>9,"image"=>"images/projects/688dd313c29be.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>57,"project_id"=>9,"image"=>"images/projects/688dd313c51f2.jpeg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>58,"project_id"=>10,"image"=>"images/projects/688dd4163dc48.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>59,"project_id"=>10,"image"=>"images/projects/688dd4163fde1.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>60,"project_id"=>10,"image"=>"images/projects/688dd41640d68.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>61,"project_id"=>11,"image"=>"images/projects/688dd4695fdaf.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>62,"project_id"=>11,"image"=>"images/projects/688dd46961a5b.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>63,"project_id"=>11,"image"=>"images/projects/688dd4696302e.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>64,"project_id"=>16,"image"=>"images/projects/688dd9b8d8378.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>65,"project_id"=>17,"image"=>"images/projects/688ddc86adfff.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>66,"project_id"=>17,"image"=>"images/projects/688ddc86b0fcf.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>67,"project_id"=>17,"image"=>"images/projects/688ddc86b26d3.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>68,"project_id"=>18,"image"=>"images/projects/688ddcdf05671.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>69,"project_id"=>20,"image"=>"images/projects/688dddbccb1ad.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>70,"project_id"=>23,"image"=>"images/projects/688de0fc2de00.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>71,"project_id"=>7,"image"=>"images/projects/688cd504c979b.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>72,"project_id"=>7,"image"=>"images/projects/688cd504cc111.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>73,"project_id"=>7,"image"=>"images/projects/688cd504cd11d.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>74,"project_id"=>7,"image"=>"images/projects/688cd504ceb2d.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>75,"project_id"=>7,"image"=>"images/projects/688cd54215290.jpeg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>76,"project_id"=>13,"image"=>"images/projects/688dd7dc571f0.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>77,"project_id"=>13,"image"=>"images/projects/688dd7dc59601.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>78,"project_id"=>13,"image"=>"images/projects/688dd7dc5a890.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>79,"project_id"=>13,"image"=>"images/projects/688dd7dc5bb28.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>80,"project_id"=>13,"image"=>"images/projects/688dd7dc5cb3e.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>81,"project_id"=>13,"image"=>"images/projects/688dd7dc5df38.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>82,"project_id"=>13,"image"=>"images/projects/688dd7dc5ee02.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>83,"project_id"=>13,"image"=>"images/projects/688dd7dc5fe48.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>84,"project_id"=>13,"image"=>"images/projects/688dd7dc60f43.webp","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>85,"project_id"=>25,"image"=>"images/projects/688de22344cd3.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>86,"project_id"=>25,"image"=>"images/projects/688de22346d42.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>87,"project_id"=>25,"image"=>"images/projects/688de22348034.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>88,"project_id"=>25,"image"=>"images/projects/688de22349545.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>89,"project_id"=>25,"image"=>"images/projects/688de2234a974.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>90,"project_id"=>25,"image"=>"images/projects/688de2234bf47.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>91,"project_id"=>27,"image"=>"images/projects/688de4d7b7fe7.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>92,"project_id"=>27,"image"=>"images/projects/688de4d7b9b98.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>93,"project_id"=>27,"image"=>"images/projects/688de4d7bb42e.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>94,"project_id"=>27,"image"=>"images/projects/688de4d7bc68f.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>95,"project_id"=>28,"image"=>"images/projects/688de5370acf2.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>96,"project_id"=>28,"image"=>"images/projects/688de5370cf0b.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>97,"project_id"=>29,"image"=>"images/projects/688de65093ca6.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>98,"project_id"=>29,"image"=>"images/projects/688de65096c64.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>99,"project_id"=>29,"image"=>"images/projects/688de650982ec.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
            ["id"=>100,"project_id"=>29,"image"=>"images/projects/688de65099762.jpg","created_at"=>"2025-08-08 23:52:00","updated_at"=>"2025-08-08 23:52:00"],
        ]);
    }
}