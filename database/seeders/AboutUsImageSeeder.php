<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutUsImage;

class AboutUsImageSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $images = [
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
                'title' => 'Company Presentation Image',
                'image_path' => 'images/about-us/presentation-section.jpg',
                'type' => 'section_image',
                'alt_text' => 'SOTUMA Company Presentation',
                'description' => 'Image for the presentation section showing our company values and mission.',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Our Mission Image',
                'image_path' => 'images/about-us/mission-section.jpg',
                'type' => 'section_image',
                'alt_text' => 'SOTUMA Mission and Vision',
                'description' => 'Visual representation of our mission to provide quality aluminum solutions.',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Objectives and Goals',
                'image_path' => 'images/about-us/objectives-section.jpg',
                'type' => 'section_image',
                'alt_text' => 'SOTUMA Objectives and Goals',
                'description' => 'Image representing our strategic objectives and company goals.',
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'Expertise and Skills',
                'image_path' => 'images/about-us/expertise-section.jpg',
                'type' => 'section_image',
                'alt_text' => 'SOTUMA Technical Expertise',
                'description' => 'Showcasing our technical expertise and professional skills in aluminum manufacturing.',
                'sort_order' => 4,
                'is_active' => true
            ],
            [
                'title' => 'Our Approach',
                'image_path' => 'images/about-us/approach-section.jpg',
                'type' => 'section_image',
                'alt_text' => 'SOTUMA Working Approach',
                'description' => 'Illustrating our systematic approach to aluminum solutions and customer service.',
                'sort_order' => 5,
                'is_active' => true
            ],
            [
                'title' => 'Team Photo',
                'image_path' => 'images/about-us/team-photo.jpg',
                'type' => 'team_image',
                'alt_text' => 'SOTUMA Professional Team',
                'description' => 'Our dedicated team of professionals committed to excellence.',
                'sort_order' => 6,
                'is_active' => true
            ],
            [
                'title' => 'Manufacturing Process',
                'image_path' => 'images/about-us/manufacturing-process.jpg',
                'type' => 'process_image',
                'alt_text' => 'SOTUMA Manufacturing Process',
                'description' => 'Our state-of-the-art manufacturing processes and quality control.',
                'sort_order' => 7,
                'is_active' => true
            ],
            [
                'title' => 'Quality Features',
                'image_path' => 'images/about-us/quality-features.jpg',
                'type' => 'feature_image',
                'alt_text' => 'SOTUMA Quality Features',
                'description' => 'Highlighting our key features and quality standards.',
                'sort_order' => 8,
                'is_active' => true
            ]
        ];

        foreach ($images as $imageData) {
            AboutUsImage::create($imageData);
        }
    }
}