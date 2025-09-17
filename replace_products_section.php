<?php

// Read the current seeder file
$seederContent = file_get_contents('database/seeders/DatabaseSeeder.php');

// Read the updated products data
$updatedProductsData = file_get_contents('updated_categories_products_data.txt');

// Extract the products section from the updated data
$lines = explode("\n", $updatedProductsData);
$productsSection = '';
$inProductsSection = false;

foreach ($lines as $line) {
    if (strpos($line, '// Products (updated with current data)') !== false) {
        $inProductsSection = true;
        $productsSection .= "        // Products (ALL 48 products with updated data and images)\n";
        continue;
    }
    
    if ($inProductsSection) {
        if (strpos($line, '        ]);') !== false && strpos($line, '// Projects') === false) {
            $productsSection .= $line . "\n";
            break;
        }
        $productsSection .= $line . "\n";
    }
}

// Find the products section in the seeder and replace it
$pattern = '/\/\/ Products \(ALL \d+ products with.*?\n        DB::table\(\'products\'\)->insert\(\[.*?\n        \]\);/s';

if (preg_match($pattern, $seederContent, $matches)) {
    $newSeederContent = str_replace($matches[0], $productsSection, $seederContent);
    file_put_contents('database/seeders/DatabaseSeeder.php', $newSeederContent);
    echo "✅ Products section updated successfully!\n";
} else {
    echo "❌ Could not find products section to replace\n";
}
