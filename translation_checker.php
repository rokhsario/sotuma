<?php

/**
 * SOTUMA Translation Checker and Fixer
 * This script will check for hardcoded text and missing translations
 */

class TranslationChecker
{
    private $frontendPath = 'resources/views/frontend';
    private $backendPath = 'resources/views/backend';
    private $langPath = 'resources/lang';
    private $issues = [];
    private $missingKeys = [];
    
    public function __construct()
    {
        echo "🔍 SOTUMA Translation Checker Started\n";
        echo "=====================================\n\n";
    }
    
    public function run()
    {
        $this->checkLanguageFiles();
        $this->checkFrontendViews();
        $this->checkBackendViews();
        $this->generateReport();
    }
    
    private function checkLanguageFiles()
    {
        echo "📁 Checking Language Files...\n";
        
        $languages = ['en', 'fr', 'ar'];
        $enKeys = $this->getTranslationKeys('en');
        
        foreach ($languages as $lang) {
            $langKeys = $this->getTranslationKeys($lang);
            $missing = array_diff($enKeys, $langKeys);
            
            if (!empty($missing)) {
                $this->missingKeys[$lang] = $missing;
                echo "❌ Missing keys in {$lang}: " . count($missing) . " keys\n";
            } else {
                echo "✅ {$lang} language file is complete\n";
            }
        }
        
        echo "\n";
    }
    
    private function getTranslationKeys($lang)
    {
        $file = "{$this->langPath}/{$lang}/frontend.php";
        if (!file_exists($file)) {
            return [];
        }
        
        $translations = include $file;
        return array_keys($translations);
    }
    
    private function checkFrontendViews()
    {
        echo "🌐 Checking Frontend Views...\n";
        
        $hardcodedTexts = [
            'Voir détails',
            'Page d\'accueil',
            'Produits',
            'Aucun produit trouvé',
            'Aucun produit n\'est disponible',
            'Aucun projet disponible',
            'Nos Produits',
            'Nos Catégories de Produits',
            'Une large gamme de produits',
            'Veuillez visiter',
            'la nouvelle page',
            'Ajoutez ici un aperçu',
            'des produits phares',
            'Tableau de Bord',
            'Projets',
            'Options des Projets',
            'Liste des Projets',
            'Ajouter un Projet',
            'Catégories de Projets',
            'Ajouter une Catégorie',
            'Rechercher...'
        ];
        
        $files = $this->getBladeFiles($this->frontendPath);
        foreach ($files as $file) {
            $content = file_get_contents($file);
            foreach ($hardcodedTexts as $text) {
                if (strpos($content, $text) !== false) {
                    $this->issues[] = [
                        'file' => $file,
                        'type' => 'hardcoded_text',
                        'text' => $text,
                        'severity' => 'high'
                    ];
                }
            }
        }
        
        echo "Found " . count($this->issues) . " hardcoded text issues\n\n";
    }
    
    private function checkBackendViews()
    {
        echo "⚙️ Checking Backend Views...\n";
        
        $hardcodedTexts = [
            'Tableau de Bord',
            'Projets',
            'Options des Projets',
            'Liste des Projets',
            'Ajouter un Projet',
            'Catégories de Projets',
            'Ajouter une Catégorie',
            'Produits',
            'Options des Produits',
            'Liste des Produits',
            'Ajouter un Produit',
            'Catégories de Produits',
            'Avis Clients',
            'Médias',
            'Options des Médias',
            'Liste des Articles',
            'Ajouter un Article',
            'Catégories d\'Articles',
            'Ajouter une Catégorie',
            'Commentaires',
            'Certificats',
            'Options des Certificats',
            'Liste des Certificats',
            'Ajouter un Certificat',
            'Utilisateurs',
            'Messages',
            'Configuration',
            'Paramètres',
            'Analyses',
            'Rechercher...',
            'Profil',
            'Changer le Mot de Passe',
            'Déconnexion'
        ];
        
        $files = $this->getBladeFiles($this->backendPath);
        foreach ($files as $file) {
            $content = file_get_contents($file);
            foreach ($hardcodedTexts as $text) {
                if (strpos($content, $text) !== false) {
                    $this->issues[] = [
                        'file' => $file,
                        'type' => 'hardcoded_text',
                        'text' => $text,
                        'severity' => 'high'
                    ];
                }
            }
        }
        
        echo "Found " . count($this->issues) . " backend hardcoded text issues\n\n";
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
    
    private function generateReport()
    {
        echo "📊 Translation Issues Report\n";
        echo "============================\n\n";
        
        if (empty($this->issues) && empty($this->missingKeys)) {
            echo "✅ No translation issues found!\n";
            return;
        }
        
        // Missing translation keys
        if (!empty($this->missingKeys)) {
            echo "🔑 Missing Translation Keys:\n";
            foreach ($this->missingKeys as $lang => $keys) {
                echo "  {$lang}: " . implode(', ', array_slice($keys, 0, 5));
                if (count($keys) > 5) {
                    echo " ... and " . (count($keys) - 5) . " more";
                }
                echo "\n";
            }
            echo "\n";
        }
        
        // Hardcoded text issues
        if (!empty($this->issues)) {
            echo "📝 Hardcoded Text Issues:\n";
            $grouped = [];
            foreach ($this->issues as $issue) {
                $grouped[$issue['text']][] = $issue['file'];
            }
            
            foreach ($grouped as $text => $files) {
                echo "  \"{$text}\" found in:\n";
                foreach (array_unique($files) as $file) {
                    echo "    - " . str_replace(getcwd() . '/', '', $file) . "\n";
                }
                echo "\n";
            }
        }
        
        echo "📋 Recommendations:\n";
        echo "1. Create missing translation keys in language files\n";
        echo "2. Replace hardcoded text with translation functions\n";
        echo "3. Create admin.php translation files for backend\n";
        echo "4. Test language switching functionality\n";
        echo "5. Verify RTL support for Arabic\n\n";
    }
}

// Run the checker
$checker = new TranslationChecker();
$checker->run();

echo "🎯 Translation check completed!\n";
