<?php

/**
 * SOTUMA Translation Fixer
 * This script will automatically fix hardcoded text by replacing it with translation functions
 */

class TranslationFixer
{
    private $replacements = [
        // Frontend replacements
        'frontend' => [
            'Page d\'accueil' => '{{ __(\'frontend.home_page\') }}',
            'Produits' => '{{ __(\'frontend.products\') }}',
            'Nos Catégories de Produits' => '{{ __(\'frontend.product_categories\') }}',
            'Une large gamme de produits' => '{{ __(\'frontend.wide_range_products\') }}',
            'Nos Produits' => '{{ __(\'frontend.our_products\') }}',
            'Projets' => '{{ __(\'frontend.projects\') }}',
            'Ajoutez ici un aperçu' => '{{ __(\'frontend.add_preview_here\') }}',
            'Veuillez visiter' => '{{ __(\'frontend.please_visit\') }}',
            'la nouvelle page' => '{{ __(\'frontend.new_page\') }}',
            'des produits phares' => '{{ __(\'frontend.add_preview_here\') }}',
            'Aucun projet disponible' => '{{ __(\'frontend.no_projects_available\') }}',
        ],
        
        // Backend replacements
        'backend' => [
            'Tableau de Bord' => '{{ __(\'admin.dashboard\') }}',
            'Analyses' => '{{ __(\'admin.analytics\') }}',
            'Ajouter une Catégorie' => '{{ __(\'admin.add_category\') }}',
            'Ajouter un Produit' => '{{ __(\'admin.add_product\') }}',
            'Certificats' => '{{ __(\'admin.certificates\') }}',
            'Commentaires' => '{{ __(\'admin.comments\') }}',
            'Utilisateurs' => '{{ __(\'admin.users\') }}',
            'Changer le Mot de Passe' => '{{ __(\'admin.change_password\') }}',
            'Messages' => '{{ __(\'admin.messages\') }}',
            'Médias' => '{{ __(\'admin.media\') }}',
            'Configuration' => '{{ __(\'admin.configuration\') }}',
            'Liste des Produits' => '{{ __(\'admin.product_list\') }}',
            'Catégories de Projets' => '{{ __(\'admin.project_categories\') }}',
        ]
    ];
    
    public function __construct()
    {
        echo "🔧 SOTUMA Translation Fixer Started\n";
        echo "===================================\n\n";
    }
    
    public function run()
    {
        $this->fixFrontendFiles();
        $this->fixBackendFiles();
        echo "✅ Translation fixing completed!\n";
    }
    
    private function fixFrontendFiles()
    {
        echo "🌐 Fixing Frontend Files...\n";
        
        $files = $this->getBladeFiles('resources/views/frontend');
        foreach ($files as $file) {
            $this->fixFile($file, 'frontend');
        }
        
        echo "Frontend files processed: " . count($files) . "\n";
    }
    
    private function fixBackendFiles()
    {
        echo "⚙️ Fixing Backend Files...\n";
        
        $files = $this->getBladeFiles('resources/views/backend');
        foreach ($files as $file) {
            $this->fixFile($file, 'backend');
        }
        
        echo "Backend files processed: " . count($files) . "\n";
    }
    
    private function fixFile($file, $type)
    {
        $content = file_get_contents($file);
        $originalContent = $content;
        
        foreach ($this->replacements[$type] as $search => $replace) {
            // Only replace if it's not already a translation function
            if (strpos($content, $search) !== false && strpos($content, '__(') === false) {
                $content = str_replace($search, $replace, $content);
            }
        }
        
        if ($content !== $originalContent) {
            file_put_contents($file, $content);
            echo "  ✅ Fixed: " . str_replace(getcwd() . '/', '', $file) . "\n";
        }
    }
    
    private function getBladeFiles($path)
    {
        $files = [];
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path)
        );
        
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $files[] = $file->getPathname();
            }
        }
        
        return $files;
    }
}

// Run the fixer
$fixer = new TranslationFixer();
$fixer->run();
