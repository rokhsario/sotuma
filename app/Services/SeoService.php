<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use App\Models\Category;

class SeoService
{
    private $siteName = 'SOTUMA';
    private $siteUrl = 'https://sotuma.net';
    private $siteDescription = 'SOTUMA - Leader en fabrication et installation de menuiserie aluminium, volets roulants, portes et fenêtres à Sfax, Tunisie. Solutions innovantes et durables pour votre habitat.';
    
    private $keywords = [
        // Main keywords
        'aluminium', 'tpr', 'tpr aluminium', 'tpr sfax', 'sotuma', 'sotuma sfax', 'menuiserie aluminium', 'produits aluminium', 'volets roulants',
        'portes aluminium', 'fenêtres aluminium', 'menuiserie aluminium sfax', 'isolation thermique',
        'isolation phonique', 'sécurité', 'qualité', 'durabilité', 'innovation', 'excellence',
        
        // Location-based keywords
        'sfax tunisie', 'sfax aluminium', 'aluminium sfax', 'menuiserie sfax', 'volets sfax', 'portes sfax',
        'fenêtres sfax', 'menuiserie aluminium sfax', 'isolation sfax',
        'tunisie aluminium', 'menuiserie tunisie', 'volets tunisie', 'portes tunisie',
        
        // Product-specific keywords
        'menuiserie pvc', 'menuiserie bois', 'store bannes', 'porte blindée', 'porte coulissante',
        'porte battante', 'fenêtre coulissante', 'fenêtre battante', 'fenêtre oscillo-battante',
        'baie vitrée', 'véranda', 'pergola', 'brise soleil', 'grille de protection',
        'moustiquaire', 'volet roulant électrique', 'volet roulant manuel', 'porte de garage',
        'porte sectionnelle', 'porte basculante', 'clôture aluminium', 'portail aluminium',
        
        // Technical keywords
        'rupture de pont thermique', 'double vitrage', 'triple vitrage', 'vitrage feuilleté',
        'vitrage trempé', 'vitrage sécurit', 'profilé aluminium', 'profilé pvc',
        'système coulissant', 'système oscillo-battant', 'système battant', 'système pivotant',
        'moteur volet roulant', 'télécommande volet', 'domotique', 'automatisation',
        
        // Service keywords
        'installation aluminium', 'pose menuiserie', 'maintenance aluminium', 'réparation volet',
        'menuiserie aluminium sfax', 'devis gratuit', 'conseil technique',
        'garantie produit', 'service après-vente', 'livraison gratuite', 'installation gratuite',
        
        // Brand and company keywords
        'sotuma aluminium', 'sotuma sfax', 'sotuma tunisie', 'entreprise sotuma',
        'société sotuma', 'marque sotuma', 'leader aluminium', 'expert menuiserie',
        'spécialiste volets', 'référence qualité',
        
        // Industry keywords
        'construction tunisie', 'bâtiment tunisie', 'rénovation tunisie', 'amélioration habitat',
        'efficacité énergétique', 'économie énergie', 'confort thermique', 'confort acoustique',
        'sécurité domicile', 'protection domicile', 'esthétique maison', 'décoration extérieure',
        
        // Long-tail keywords
        'meilleur fabricant aluminium sfax', 'prix menuiserie aluminium sfax', 'devis volet roulant sfax',
        'menuiserie aluminium sfax', 'isolation maison sfax',
        'menuiserie sur mesure sfax', 'porte blindée sfax', 'fenêtre sécurisée sfax',
        'véranda aluminium sfax', 'pergola sfax', 'store banne sfax', 'brise soleil sfax',
        'grille protection sfax', 'moustiquaire sfax', 'porte garage sfax', 'clôture sfax',
        'portail automatique sfax', 'domotique maison sfax', 'automatisation maison sfax',
        
        // Seasonal and promotional keywords
        'promotion aluminium', 'offre spéciale menuiserie', 'réduction volets', 'fin de série', 'liquidation stock', 'prix cassé', 'devis rapide',
        'installation express', 'livraison rapide', 'paiement échelonné', 'crédit consommation'
    ];
    
    public function getMetaTags($page = 'home', $data = [])
    {
        $meta = [];
        
        switch ($page) {
            case 'home':
                $meta = $this->getHomeMeta();
                break;
            case 'about':
                $meta = $this->getAboutMeta();
                break;
            case 'contact':
                $meta = $this->getContactMeta();
                break;
            case 'products':
                $meta = $this->getProductsMeta();
                break;
            case 'categories':
                $meta = $this->getCategoriesMeta();
                break;
            case 'project-categories':
                $meta = $this->getProjectCategoriesMeta();
                break;
            case 'blog':
                $meta = $this->getBlogMeta();
                break;
            case 'certificates':
                $meta = $this->getCertificatesMeta();
                break;
            case 'product-detail':
                $meta = $this->getProductDetailMeta($data);
                break;
            case 'project-detail':
                $meta = $this->getProjectDetailMeta($data);
                break;
            case 'category-detail':
                $meta = $this->getCategoryDetailMeta($data);
                break;
            case 'project-category-detail':
                $meta = $this->getProjectCategoryDetailMeta($data);
                break;
            default:
                $meta = $this->getDefaultMeta();
        }
        
        return $meta;
    }
    
    private function getHomeMeta()
    {
        return [
            'title' => 'SOTUMA - Menuiserie Aluminium Sfax | Volets, Portes, Fenêtres',
            'description' => 'SOTUMA – Menuiserie aluminium à Sfax: portes, fenêtres, volets roulants, pergolas. Qualité, sur mesure, devis gratuit et installation professionnelle.',
            'keywords' => $this->getKeywordsString(),
            'og_title' => 'SOTUMA - Menuiserie Aluminium Sfax',
            'og_description' => 'Solutions en menuiserie aluminium (portes, fenêtres, volets, pergolas) à Sfax',
            'og_image' => $this->siteUrl . '/images/sotuma-logo.jpg',
            'canonical' => $this->siteUrl
        ];
    }
    
    private function getAboutMeta()
    {
        return [
            'title' => 'À Propos de SOTUMA - Expertise Menuiserie Aluminium Sfax',
            'description' => 'Découvrez l\'histoire de SOTUMA, entreprise leader en menuiserie aluminium à Sfax. 20+ ans d\'expertise, innovation et qualité au service de vos projets.',
            'keywords' => $this->getKeywordsString(),
            'og_title' => 'À Propos de SOTUMA',
            'og_description' => 'Leader en menuiserie aluminium à Sfax depuis plus de 20 ans',
            'canonical' => $this->siteUrl . '/about'
        ];
    }
    
    private function getContactMeta()
    {
        return [
            'title' => 'Contact SOTUMA Sfax - Devis Gratuit Menuiserie Aluminium',
            'description' => 'Contactez SOTUMA à Sfax pour vos projets de menuiserie aluminium. Devis gratuit, conseils experts et installation professionnelle. Adresse, téléphone, email.',
            'keywords' => $this->getKeywordsString(),
            'og_title' => 'Contact SOTUMA',
            'og_description' => 'Contactez-nous pour vos projets de menuiserie aluminium',
            'canonical' => $this->siteUrl . '/contact'
        ];
    }
    
    private function getProductsMeta()
    {
        return [
            'title' => 'Produits SOTUMA - Menuiserie Aluminium Sfax',
            'description' => 'Découvrez notre gamme complète de produits : menuiserie aluminium, volets roulants, portes et fenêtres à Sfax. Qualité et innovation garanties.',
            'keywords' => $this->getKeywordsString(),
            'og_title' => 'Produits SOTUMA',
            'og_description' => 'Gamme complète de menuiserie aluminium à Sfax',
            'canonical' => $this->siteUrl . '/products'
        ];
    }
    
    private function getCategoriesMeta()
    {
        return [
            'title' => 'Catégories Produits SOTUMA - Menuiserie Aluminium Sfax',
            'description' => 'Explorez nos catégories de produits : portes aluminium, fenêtres et volets roulants. Solutions sur mesure pour votre habitat à Sfax.',
            'keywords' => $this->getKeywordsString(),
            'og_title' => 'Catégories Produits',
            'og_description' => 'Découvrez nos catégories de produits aluminium',
            'canonical' => $this->siteUrl . '/categories'
        ];
    }
    
    private function getProjectCategoriesMeta()
    {
        return [
            'title' => 'Nos Projets SOTUMA - Réalisations Menuiserie Aluminium Sfax',
            'description' => 'Découvrez nos réalisations et projets de menuiserie aluminium à Sfax. Galerie photos de nos travaux : résidentiel, commercial, industriel.',
            'keywords' => $this->getKeywordsString(),
            'og_title' => 'Nos Projets',
            'og_description' => 'Découvrez nos réalisations en menuiserie aluminium',
            'canonical' => $this->siteUrl . '/project-categories'
        ];
    }
    
    private function getBlogMeta()
    {
        return [
            'title' => 'Blog SOTUMA - Actualités Menuiserie Aluminium Sfax',
            'description' => 'Restez informé des dernières tendances en menuiserie aluminium, conseils d\'entretien et actualités SOTUMA. Articles experts et guides pratiques.',
            'keywords' => $this->getKeywordsString(),
            'og_title' => 'Blog SOTUMA',
            'og_description' => 'Actualités et conseils en menuiserie aluminium',
            'canonical' => $this->siteUrl . '/blog'
        ];
    }
    
    private function getCertificatesMeta()
    {
        return [
            'title' => 'Certifications SOTUMA - Qualité et Normes Menuiserie Aluminium',
            'description' => 'Découvrez les certifications et normes qualité de SOTUMA. Garanties, labels et attestations de nos produits et services.',
            'keywords' => $this->getKeywordsString(),
            'og_title' => 'Certifications SOTUMA',
            'og_description' => 'Nos certifications et normes qualité',
            'canonical' => $this->siteUrl . '/certificates'
        ];
    }
    
    private function getProductDetailMeta($data)
    {
        $product = $data['product'] ?? null;
        if (!$product) return $this->getDefaultMeta();
        
        return [
            'title' => $product->title . ' - SOTUMA Sfax | Menuiserie Aluminium',
            'description' => 'Découvrez ' . $product->title . ' chez SOTUMA. Qualité premium, installation professionnelle et garantie. Devis gratuit à Sfax.',
            'keywords' => $this->getKeywordsString([strtolower($product->title)]),
            'og_title' => $product->title . ' - SOTUMA',
            'og_description' => 'Découvrez ce produit de qualité chez SOTUMA',
            'canonical' => $this->siteUrl . '/product/' . $product->slug
        ];
    }
    
    private function getProjectDetailMeta($data)
    {
        $project = $data['project'] ?? null;
        if (!$project) return $this->getDefaultMeta();
        
        return [
            'title' => $project->title . ' - Projet SOTUMA | Menuiserie Aluminium Sfax',
            'description' => 'Découvrez le projet ' . $project->title . ' réalisé par SOTUMA. Expertise en menuiserie aluminium à Sfax.',
            'keywords' => $this->getKeywordsString([strtolower($project->title)]),
            'og_title' => $project->title . ' - Projet SOTUMA',
            'og_description' => 'Découvrez cette réalisation SOTUMA',
            'canonical' => $this->siteUrl . '/projet/' . $project->slug
        ];
    }
    
    private function getCategoryDetailMeta($data)
    {
        $category = $data['category'] ?? null;
        if (!$category) return $this->getDefaultMeta();
        
        return [
            'title' => $category->title . ' - SOTUMA Sfax | Menuiserie Aluminium',
            'description' => 'Découvrez notre gamme ' . $category->title . ' chez SOTUMA. Qualité premium et installation professionnelle à Sfax.',
            'keywords' => $this->getKeywordsString([strtolower($category->title)]),
            'og_title' => $category->title . ' - SOTUMA',
            'og_description' => 'Découvrez cette catégorie de produits SOTUMA',
            'canonical' => $this->siteUrl . '/categories/' . $category->slug
        ];
    }
    
    private function getProjectCategoryDetailMeta($data)
    {
        $category = $data['category'] ?? null;
        if (!$category) return $this->getDefaultMeta();
        
        return [
            'title' => $category->title . ' - Projets SOTUMA | Menuiserie Aluminium Sfax',
            'description' => 'Découvrez nos projets ' . $category->title . ' réalisés par SOTUMA. Expertise en menuiserie aluminium à Sfax.',
            'keywords' => $this->getKeywordsString([strtolower($category->title)]),
            'og_title' => $category->title . ' - Projets SOTUMA',
            'og_description' => 'Découvrez nos projets dans cette catégorie',
            'canonical' => $this->siteUrl . '/categories-projets/' . $category->slug
        ];
    }
    
    private function getDefaultMeta()
    {
        return [
            'title' => 'SOTUMA - Menuiserie Aluminium Sfax',
            'description' => $this->siteDescription,
            'keywords' => $this->getKeywordsString(),
            'canonical' => $this->siteUrl
        ];
    }
    
    private function getKeywordsString(array $extra = [])
    {
        $dynamic = $this->getDynamicKeywords();
        // Priority keywords always first
        $priority = [
            'sotuma', 'sotuma sfax', 'aluminium', 'aluminium sfax',
            'sotuma aluminium', 'sotuma aluminium sfax'
        ];
        $all = array_merge($priority, $this->keywords, $dynamic, $extra);
        // Normalize, dedupe, and trim
        $all = array_filter(array_unique(array_map(function($k){
            return trim(mb_strtolower($k));
        }, $all)));
        // Cap to 200 max keywords
        if (count($all) > 200) {
            $all = array_slice($all, 0, 200);
        }
        return implode(', ', $all);
    }

    private function getDynamicKeywords(): array
    {
        return Cache::remember('seo.dynamic_keywords', 3600, function(){
            $productTitles = [];
            $categoryTitles = [];
            try {
                if (class_exists(Product::class)) {
                    $productTitles = Product::query()->whereNotNull('title')->limit(500)->pluck('title')->all();
                }
                if (class_exists(Category::class)) {
                    $categoryTitles = Category::query()->whereNotNull('title')->limit(500)->pluck('title')->all();
                }
            } catch (\Throwable $e) {
                // On failure (e.g., during install), return base only
                return [];
            }

            $keywords = [];
            foreach (array_merge($productTitles, $categoryTitles) as $title) {
                $t = trim(mb_strtolower($title));
                if ($t === '') continue;
                $keywords[] = $t;                 // product/category name
                $keywords[] = 'sotuma ' . $t;     // brand + name
                $keywords[] = $t . ' sfax';       // geo + name
                $keywords[] = 'aluminium ' . $t;  // material + name
            }

            return array_values(array_unique($keywords));
        });
    }
    
    public function getStructuredData($page = 'home', $data = [])
    {
        $structuredData = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'SOTUMA',
            'url' => $this->siteUrl,
            'logo' => $this->siteUrl . '/images/sotuma-logo.png',
            'description' => $this->siteDescription,
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Adresse SOTUMA',
                'addressLocality' => 'Sfax',
                'addressCountry' => 'TN'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+216-XX-XXX-XXX',
                'contactType' => 'customer service',
                'areaServed' => 'TN',
                'availableLanguage' => ['French', 'Arabic']
            ],
            'sameAs' => [
                'https://www.facebook.com/sotumasfax',
                'https://www.instagram.com/sotuma_aluminium/',
                'https://www.linkedin.com/company/sotuma/',
                'https://www.tiktok.com/@sotumasotuma'
            ]
        ];
        
        return json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
