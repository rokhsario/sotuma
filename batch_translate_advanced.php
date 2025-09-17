<?php
/**
 * Advanced Batch Translation Script for SOTUMA Frontend
 * This script systematically updates all frontend pages with proper translation keys
 * 
 * Usage: php batch_translate_advanced.php
 */

// Define all frontend pages to process
$frontendPages = [
    'resources/views/frontend/pages/contact.blade.php',
    'resources/views/frontend/pages/certificates.blade.php',
    'resources/views/frontend/pages/products.blade.php',
    'resources/views/frontend/pages/product_detail.blade.php',
    'resources/views/frontend/pages/blog.blade.php',
    'resources/views/frontend/pages/blog-detail.blade.php',
    'resources/views/frontend/pages/login.blade.php',
    'resources/views/frontend/pages/register.blade.php',
    'resources/views/frontend/layouts/footer.blade.php',
];

// Common French text patterns to look for and their translation keys
$translationPatterns = [
    // Navigation & Common
    'Acceuil' => 'frontend.home',
    'A propos' => 'frontend.about',
    'Media' => 'frontend.media',
    'Nos Projets' => 'frontend.projects',
    'Nos Produits' => 'frontend.products',
    'Nos Certificats' => 'frontend.certificates',
    'Contact' => 'frontend.contact',
    'S\'inscrire' => 'frontend.register',
    'Se connecter' => 'frontend.login',
    'Tableau de bord' => 'frontend.dashboard',
    'Tout' => 'frontend.all',
    
    // Common actions
    'Lire plus' => 'frontend.read_more',
    'En savoir plus' => 'frontend.learn_more',
    'Voir tout' => 'frontend.view_all',
    'Envoyer' => 'frontend.send',
    'Soumettre' => 'frontend.submit',
    'Rechercher' => 'frontend.search',
    'Filtrer' => 'frontend.filter',
    'Trier' => 'frontend.sort',
    'Fermer' => 'frontend.close',
    'Annuler' => 'frontend.cancel',
    'Enregistrer' => 'frontend.save',
    'Modifier' => 'frontend.edit',
    'Supprimer' => 'frontend.delete',
    'Retour' => 'frontend.back',
    'Suivant' => 'frontend.next',
    'Précédent' => 'frontend.previous',
    
    // Messages
    'Aucun résultat trouvé' => 'frontend.no_results',
    'Chargement...' => 'frontend.loading',
    'Une erreur s\'est produite' => 'frontend.error_occurred',
    'Succès' => 'frontend.success',
    'Attention' => 'frontend.warning',
    'Information' => 'frontend.info',
    
    // Social & Cookie
    'Suivez-nous' => 'frontend.follow_us',
    'Politique de Cookies' => 'frontend.cookie_title',
    'Accepter' => 'frontend.accept',
    'Refuser' => 'frontend.decline',
    
    // Contact page specific
    'Contactez-nous' => 'frontend.contact_us',
    'Formulaire de contact' => 'frontend.contact_form',
    'Nom complet' => 'frontend.full_name',
    'Email' => 'frontend.email',
    'Téléphone' => 'frontend.phone',
    'Sujet' => 'frontend.subject',
    'Message' => 'frontend.message',
    'Envoyer le message' => 'frontend.send_message',
    
    // Blog/Media specific
    'Articles récents' => 'frontend.recent_posts',
    'Catégories' => 'frontend.categories',
    'Tags' => 'frontend.tags',
    'Commentaires' => 'frontend.comments',
    'Laisser un commentaire' => 'frontend.leave_comment',
    'Publier le commentaire' => 'frontend.post_comment',
    
    // Product specific
    'Prix' => 'frontend.price',
    'Ajouter au panier' => 'frontend.add_to_cart',
    'Description' => 'frontend.description',
    'Caractéristiques' => 'frontend.features',
    'Spécifications' => 'frontend.specifications',
    'Avis clients' => 'frontend.customer_reviews',
    'Note' => 'frontend.rating',
    'Étoiles' => 'frontend.stars',
    
    // Authentication
    'Mot de passe' => 'frontend.password',
    'Confirmer le mot de passe' => 'frontend.confirm_password',
    'Se souvenir de moi' => 'frontend.remember_me',
    'Mot de passe oublié' => 'frontend.forgot_password',
    'Réinitialiser le mot de passe' => 'frontend.reset_password',
    'J\'ai déjà un compte' => 'frontend.have_account',
    'Je n\'ai pas de compte' => 'frontend.no_account',
    
    // Footer
    'À propos de SOTUMA' => 'frontend.about_sotuma',
    'Liens rapides' => 'frontend.quick_links',
    'Services' => 'frontend.services',
    'Support' => 'frontend.support',
    'Newsletter' => 'frontend.newsletter',
    'S\'abonner' => 'frontend.subscribe',
    'Tous droits réservés' => 'frontend.all_rights_reserved',
    'Conditions d\'utilisation' => 'frontend.terms_of_service',
    'Politique de confidentialité' => 'frontend.privacy_policy',
];

echo "=== SOTUMA Advanced Frontend Translation Helper ===\n\n";

$totalChanges = 0;
$processedFiles = 0;

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
        $totalChanges += $changes;
        $processedFiles++;
    } else {
        echo "  ℹ️  No changes needed\n";
    }
    
    echo "\n";
}

echo "=== Translation Summary ===\n";
echo "📊 Files processed: $processedFiles\n";
echo "📊 Total changes: $totalChanges\n\n";

echo "=== Next Steps ===\n";
echo "1. ✅ Review the changes in each file\n";
echo "2. ✅ Add any missing translation keys to language files\n";
echo "3. ✅ Test the language switcher functionality\n";
echo "4. ✅ Check RTL support for Arabic language\n";
echo "5. ✅ Update admin dashboard translations\n\n";

echo "🔧 Language files to update:\n";
echo "- resources/lang/en/frontend.php\n";
echo "- resources/lang/fr/frontend.php\n";
echo "- resources/lang/ar/frontend.php\n\n";

echo "🌐 To test translations:\n";
echo "- Visit: /?lang=en (English)\n";
echo "- Visit: /?lang=fr (French)\n";
echo "- Visit: /?lang=ar (Arabic)\n\n";

echo "📝 Note: All translation keys now use 'frontend.' prefix for better organization\n";
?>
