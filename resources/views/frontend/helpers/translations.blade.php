{{-- 
    Translation Helper for Frontend Pages
    Use this file as a reference for common translation patterns
--}}

{{-- Common Navigation Translations --}}
{{-- Replace hardcoded text with: {{ __('key') }} --}}

{{-- Navigation Menu --}}
{{-- 'home' => 'Home/Accueil/الرئيسية' --}}
{{-- 'about' => 'About/À propos/من نحن' --}}
{{-- 'media' => 'Media/Média/الوسائط' --}}
{{-- 'projects' => 'Our Projects/Nos Projets/مشاريعنا' --}}
{{-- 'products' => 'Our Products/Nos Produits/منتجاتنا' --}}
{{-- 'certificates' => 'Our Certificates/Nos Certificats/شهاداتنا' --}}
{{-- 'contact' => 'Contact/Contact/اتصل بنا' --}}

{{-- Authentication --}}
{{-- 'register' => 'Register/S\'inscrire/تسجيل' --}}
{{-- 'login' => 'Login/Se connecter/تسجيل الدخول' --}}
{{-- 'dashboard' => 'Dashboard/Tableau de bord/لوحة التحكم' --}}

{{-- Common Actions --}}
{{-- 'read_more' => 'Read More/Lire plus/اقرأ المزيد' --}}
{{-- 'learn_more' => 'Learn More/En savoir plus/اعرف المزيد' --}}
{{-- 'view_all' => 'View All/Voir tout/عرض الكل' --}}
{{-- 'send' => 'Send/Envoyer/إرسال' --}}
{{-- 'submit' => 'Submit/Soumettre/إرسال' --}}
{{-- 'search' => 'Search/Rechercher/بحث' --}}
{{-- 'filter' => 'Filter/Filtrer/تصفية' --}}
{{-- 'sort' => 'Sort/Trier/ترتيب' --}}
{{-- 'close' => 'Close/Fermer/إغلاق' --}}
{{-- 'cancel' => 'Cancel/Annuler/إلغاء' --}}
{{-- 'save' => 'Save/Enregistrer/حفظ' --}}
{{-- 'edit' => 'Edit/Modifier/تعديل' --}}
{{-- 'delete' => 'Delete/Supprimer/حذف' --}}
{{-- 'back' => 'Back/Retour/رجوع' --}}
{{-- 'next' => 'Next/Suivant/التالي' --}}
{{-- 'previous' => 'Previous/Précédent/السابق' --}}

{{-- Messages --}}
{{-- 'no_results' => 'No results found/Aucun résultat trouvé/لم يتم العثور على نتائج' --}}
{{-- 'loading' => 'Loading.../Chargement.../جاري التحميل...' --}}
{{-- 'error_occurred' => 'An error occurred/Une erreur s\'est produite/حدث خطأ' --}}
{{-- 'success' => 'Success/Succès/نجح' --}}
{{-- 'warning' => 'Warning/Attention/تحذير' --}}
{{-- 'info' => 'Information/Information/معلومات' --}}

{{-- Home Page Specific --}}
{{-- 'innovation_elegance' => 'Innovation and elegance in aluminum/L\'innovation et l\'élégance en aluminium/الابتكار والأناقة في الألمنيوم' --}}
{{-- 'excellence_since_2014' => 'Excellence in Aluminum since 2014/Excellence en Aluminium depuis 2014/التميز في الألمنيوم منذ 2014' --}}
{{-- 'products' => 'PRODUCTS/PRODUITS/المنتجات' --}}
{{-- 'projects' => 'PROJECTS/PROJETS/المشاريع' --}}
{{-- 'discover_more' => 'Discover more/Découvrez plus/اكتشف المزيد' --}}

{{-- Social Media & Cookie Banner --}}
{{-- 'follow_us' => 'Follow Us/Suivez-nous/تابعنا' --}}
{{-- 'cookie_title' => 'Cookie Policy/Politique de Cookies/سياسة ملفات تعريف الارتباط' --}}
{{-- 'cookie_text' => 'Cookie usage text...' --}}
{{-- 'accept' => 'Accept/Accepter/قبول' --}}
{{-- 'decline' => 'Decline/Refuser/رفض' --}}

{{-- 
    Usage Examples:
    
    1. Replace hardcoded text:
       Before: <h1>Welcome to SOTUMA</h1>
       After:  <h1>{{ __('welcome_sotuma') }}</h1>
    
    2. For buttons:
       Before: <button>Submit</button>
       After:  <button>{{ __('submit') }}</button>
    
    3. For links:
       Before: <a href="/about">About Us</a>
       After:  <a href="{{ route('about-us') }}">{{ __('about') }}</a>
    
    4. For placeholders:
       Before: <input placeholder="Search products...">
       After:  <input placeholder="{{ __('search_products') }}">
    
    Remember to add new translation keys to all three language files:
    - resources/lang/en.php
    - resources/lang/fr.php  
    - resources/lang/ar.php
--}}
