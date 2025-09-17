<?php

/**
 * SOTUMA Translation Test Script
 * This script tests the translation system functionality
 */

class TranslationTest
{
    private $languages = ['en', 'fr', 'ar'];
    private $testKeys = [
        'frontend.home',
        'frontend.about',
        'frontend.products',
        'frontend.projects',
        'frontend.contact',
        'admin.dashboard',
        'admin.users',
        'admin.settings',
        'frontend.view_details',
        'frontend.no_products_found'
    ];
    
    public function __construct()
    {
        echo "🧪 SOTUMA Translation Test Started\n";
        echo "==================================\n\n";
    }
    
    public function run()
    {
        $this->testLanguageFiles();
        $this->testTranslationKeys();
        $this->testRTLSupport();
        $this->generateReport();
    }
    
    private function testLanguageFiles()
    {
        echo "📁 Testing Language Files...\n";
        
        foreach ($this->languages as $lang) {
            $frontendFile = "resources/lang/{$lang}/frontend.php";
            $adminFile = "resources/lang/{$lang}/admin.php";
            
            if (file_exists($frontendFile)) {
                echo "  ✅ {$lang}/frontend.php exists\n";
            } else {
                echo "  ❌ {$lang}/frontend.php missing\n";
            }
            
            if (file_exists($adminFile)) {
                echo "  ✅ {$lang}/admin.php exists\n";
            } else {
                echo "  ❌ {$lang}/admin.php missing\n";
            }
        }
        
        echo "\n";
    }
    
    private function testTranslationKeys()
    {
        echo "🔑 Testing Translation Keys...\n";
        
        foreach ($this->languages as $lang) {
            echo "  Testing {$lang}:\n";
            
            $frontendTranslations = $this->loadTranslations("resources/lang/{$lang}/frontend.php");
            $adminTranslations = $this->loadTranslations("resources/lang/{$lang}/admin.php");
            
            foreach ($this->testKeys as $key) {
                $namespace = explode('.', $key)[0];
                $translationKey = explode('.', $key, 2)[1];
                
                if ($namespace === 'frontend') {
                    $translations = $frontendTranslations;
                } else {
                    $translations = $adminTranslations;
                }
                
                if (isset($translations[$translationKey])) {
                    echo "    ✅ {$key}\n";
                } else {
                    echo "    ❌ {$key} missing\n";
                }
            }
        }
        
        echo "\n";
    }
    
    private function testRTLSupport()
    {
        echo "🌍 Testing RTL Support...\n";
        
        $arTranslations = $this->loadTranslations("resources/lang/ar/frontend.php");
        
        // Test some Arabic translations
        $testKeys = ['home', 'about', 'products', 'contact'];
        $allRTL = true;
        
        foreach ($testKeys as $key) {
            if (isset($arTranslations[$key])) {
                $text = $arTranslations[$key];
                // Simple check for Arabic characters
                if (preg_match('/[\x{0600}-\x{06FF}]/u', $text)) {
                    echo "  ✅ {$key}: Arabic text detected\n";
                } else {
                    echo "  ⚠️  {$key}: No Arabic characters found\n";
                    $allRTL = false;
                }
            }
        }
        
        if ($allRTL) {
            echo "  ✅ RTL support appears to be working\n";
        } else {
            echo "  ⚠️  RTL support may need attention\n";
        }
        
        echo "\n";
    }
    
    private function loadTranslations($file)
    {
        if (!file_exists($file)) {
            return [];
        }
        
        return include $file;
    }
    
    private function generateReport()
    {
        echo "📊 Translation Test Report\n";
        echo "==========================\n\n";
        
        echo "✅ Completed Tests:\n";
        echo "  - Language file existence\n";
        echo "  - Translation key availability\n";
        echo "  - RTL support verification\n\n";
        
        echo "🎯 Recommendations:\n";
        echo "  1. Test language switching in browser\n";
        echo "  2. Verify RTL layout for Arabic\n";
        echo "  3. Check mobile responsiveness with translations\n";
        echo "  4. Test all major pages in all languages\n";
        echo "  5. Verify admin panel translations\n\n";
        
        echo "🌐 Test URLs:\n";
        echo "  English: /?lang=en\n";
        echo "  French:  /?lang=fr\n";
        echo "  Arabic:  /?lang=ar\n\n";
        
        echo "🔧 Next Steps:\n";
        echo "  1. Run the application and test language switching\n";
        echo "  2. Check for any missing translations in browser\n";
        echo "  3. Verify RTL layout works correctly\n";
        echo "  4. Test admin panel in different languages\n";
    }
}

// Run the test
$test = new TranslationTest();
$test->run();

echo "🎯 Translation test completed!\n";
