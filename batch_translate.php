<?php
/**
 * Batch Translation Helper Script
 * This script helps you identify and replace hardcoded text in frontend pages
 * 
 * Usage: php batch_translate.php
 */

// Common French text patterns to look for and their translation keys
$translationPatterns = [
    // Navigation
    'Acceuil' => 'home',
    'A propos' => 'about',
    'Media' => 'media',
    'Nos Projets' => 'projects',
    'Nos Produits' => 'products',
    'Nos Certificats' => 'certificates',
    'Contact' => 'contact',
    'S\'inscrire' => 'register',
    'Se connecter' => 'login',
    'Tableau de bord' => 'dashboard',
    'Tout' => 'all',
    
    // Common actions
    'Lire plus' => 'read_more',
    'En savoir plus' => 'learn_more',
    'Voir tout' => 'view_all',
    'Envoyer' => 'send',
    'Soumettre' => 'submit',
    'Rechercher' => 'search',
    'Filtrer' => 'filter',
    'Trier' => 'sort',
    'Fermer' => 'close',
    'Annuler' => 'cancel',
    'Enregistrer' => 'save',
    'Modifier' => 'edit',
    'Supprimer' => 'delete',
    'Retour' => 'back',
    'Suivant' => 'next',
    'Précédent' => 'previous',
    
    // Messages
    'Aucun résultat trouvé' => 'no_results',
    'Chargement...' => 'loading',
    'Une erreur s\'est produite' => 'error_occurred',
    'Succès' => 'success',
    'Attention' => 'warning',
    'Information' => 'info',
    
    // Home page
    'L\'innovation et l\'élégance en aluminium' => 'innovation_elegance',
    'Excellence en Aluminium depuis 2014' => 'excellence_since_2014',
    'PRODUITS' => 'products',
    'PROJETS' => 'projects',
    'Découvrez plus' => 'discover_more',
    
    // Social & Cookie
    'Suivez-nous' => 'follow_us',
    'Politique de Cookies' => 'cookie_title',
    'Accepter' => 'accept',
    'Refuser' => 'decline',
];

// Frontend pages to process
$frontendPages = [
    'resources/views/frontend/pages/contact.blade.php',
    'resources/views/frontend/pages/certificates.blade.php',
    'resources/views/frontend/pages/products.blade.php',
    'resources/views/frontend/pages/product_detail.blade.php',
    'resources/views/frontend/pages/blog.blade.php',
    'resources/views/frontend/pages/blog-detail.blade.php',
    'resources/views/frontend/pages/login.blade.php',
    'resources/views/frontend/pages/register.blade.php',
];

echo "=== SOTUMA Frontend Translation Helper ===\n\n";

foreach ($frontendPages as $page) {
    if (!file_exists($page)) {
        echo "⚠️  File not found: $page\n";
        continue;
    }
    
    echo "📄 Processing: $page\n";
    $content = file_get_contents($page);
    $originalContent = $content;
    $changes = 0;
    
    foreach ($translationPatterns as $frenchText => $translationKey) {
        $pattern = '/\b' . preg_quote($frenchText, '/') . '\b/';
        if (preg_match($pattern, $content)) {
            $replacement = "{{ __('$translationKey') }}";
            $content = preg_replace($pattern, $replacement, $content);
            $changes++;
            echo "  ✅ Replaced: '$frenchText' → {{ __('$translationKey') }}\n";
        }
    }
    
    if ($changes > 0) {
        // Create backup
        $backupFile = $page . '.backup.' . date('Y-m-d-H-i-s');
        file_put_contents($backupFile, $originalContent);
        echo "  💾 Backup created: $backupFile\n";
        
        // Update file
        file_put_contents($page, $content);
        echo "  🔄 Updated file with $changes changes\n";
    } else {
        echo "  ℹ️  No changes needed\n";
    }
    
    echo "\n";
}

echo "=== Translation Helper Complete ===\n";
echo "📝 Next steps:\n";
echo "1. Review the changes in each file\n";
echo "2. Add any missing translation keys to language files\n";
echo "3. Test the language switcher functionality\n";
echo "4. Check RTL support for Arabic language\n\n";

echo "🔧 Language files to update:\n";
echo "- resources/lang/en.php\n";
echo "- resources/lang/fr.php\n";
echo "- resources/lang/ar.php\n\n";

echo "🌐 To test translations:\n";
echo "- Visit: /?lang=en (English)\n";
echo "- Visit: /?lang=fr (French)\n";
echo "- Visit: /?lang=ar (Arabic)\n";
?>
