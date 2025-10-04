<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUsImage;

class AboutUsImageDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default images for About Us page
        $defaultImages = [
            [
                'title' => 'Hero Background - SOTUMA Excellence',
                'image_path' => 'images/about-us/hero-bg-default.jpg',
                'type' => 'hero_bg',
                'alt_text' => 'SOTUMA Hero Background - Excellence in Aluminum',
                'description' => 'Main hero background image for the About Us page showcasing SOTUMA\'s commitment to excellence.',
                'sort_order' => 0,
                'is_active' => true
            ],
            [
                'title' => 'Section Image - Our Story',
                'image_path' => 'images/about-us/hero-bg-default.jpg',
                'type' => 'section_image',
                'alt_text' => 'SOTUMA Section Image - Our Story',
                'description' => 'Default section image for About Us page content sections.',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Team Image - Our Experts',
                'image_path' => 'images/about-us/hero-bg-default.jpg',
                'type' => 'team_image',
                'alt_text' => 'SOTUMA Team - Our Expert Professionals',
                'description' => 'Default team image showcasing SOTUMA\'s professional team.',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Process Image - Our Method',
                'image_path' => 'images/about-us/hero-bg-default.jpg',
                'type' => 'process_image',
                'alt_text' => 'SOTUMA Process - Our Manufacturing Method',
                'description' => 'Default process image showing SOTUMA\'s manufacturing process.',
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'Feature Image - Our Advantages',
                'image_path' => 'images/about-us/hero-bg-default.jpg',
                'type' => 'feature_image',
                'alt_text' => 'SOTUMA Features - Our Key Advantages',
                'description' => 'Default feature image highlighting SOTUMA\'s key advantages.',
                'sort_order' => 4,
                'is_active' => true
            ]
        ];

        // Check if images already exist for each type
        foreach ($defaultImages as $imageData) {
            $existingImage = AboutUsImage::where('type', $imageData['type'])
                ->where('is_active', true)
                ->first();

            if (!$existingImage) {
                AboutUsImage::create($imageData);
                $this->command->info("Created default {$imageData['type']} image");
            } else {
                $this->command->info("Default {$imageData['type']} image already exists");
            }
        }

        $this->command->info('About Us default images seeding completed!');
    }
}