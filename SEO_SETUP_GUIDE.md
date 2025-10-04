# SOTUMA SEO Setup Guide

## 🚀 Complete SEO Implementation

This guide documents the comprehensive SEO setup implemented for the SOTUMA website.

## 📋 Features Implemented

### 1. XML Sitemap Generator
- **Location**: `/sitemap.xml`
- **Controller**: `SitemapController`
- **Features**:
  - Dynamic generation of all pages
  - Static pages (home, about, contact, products, etc.)
  - Project categories and individual projects
  - Product categories and individual products
  - Proper priority and change frequency settings
  - Last modified dates

### 2. Robots.txt File
- **Location**: `/public/robots.txt`
- **Features**:
  - Allows all search engines
  - Blocks admin areas and sensitive directories
  - Allows important pages and static assets
  - References sitemap location
  - Crawl delay optimization

### 3. Google Tag Manager Integration
- **GTM Container ID**: `GTM-XXXXXXX` (Replace with actual ID)
- **Implementation**:
  - Script in `<head>` section
  - Noscript fallback in `<body>`
  - Ready for tracking setup

### 4. Comprehensive SEO Service
- **Location**: `app/Services/SeoService.php`
- **Features**:
  - Dynamic meta tags for all pages
  - 150+ targeted keywords
  - Open Graph and Twitter Card support
  - Structured data (JSON-LD)
  - Page-specific optimizations

## 🎯 SEO Keywords (150+ Words)

### Primary Keywords
- aluminium, sotuma, tpr, sotuma sfax
- menuiserie aluminium, volets roulants
- portes aluminium, fenêtres aluminium
- climatisation, chauffage, isolation thermique
- isolation phonique, sécurité, qualité

### Location-Based Keywords
- sfax tunisie, sfax aluminium, menuiserie sfax
- volets sfax, portes sfax, fenêtres sfax
- climatisation sfax, chauffage sfax, isolation sfax
- tunisie aluminium, menuiserie tunisie

### Product-Specific Keywords
- menuiserie pvc, menuiserie bois, store bannes
- porte blindée, porte coulissante, porte battante
- fenêtre coulissante, fenêtre battante, fenêtre oscillo-battante
- baie vitrée, véranda, pergola, brise soleil
- grille de protection, moustiquaire
- volet roulant électrique, volet roulant manuel
- porte de garage, porte sectionnelle, porte basculante
- clôture aluminium, portail aluminium

### Technical Keywords
- rupture de pont thermique, double vitrage, triple vitrage
- vitrage feuilleté, vitrage trempé, vitrage sécurit
- profilé aluminium, profilé pvc
- système coulissant, système oscillo-battant
- système battant, système pivotant
- moteur volet roulant, télécommande volet
- domotique, automatisation

### Service Keywords
- installation aluminium, pose menuiserie
- maintenance aluminium, réparation volet
- dépannage climatisation, entretien chauffage
- devis gratuit, conseil technique
- garantie produit, service après-vente
- livraison gratuite, installation gratuite

### Brand Keywords
- sotuma aluminium, sotuma sfax, sotuma tunisie
- entreprise sotuma, société sotuma, marque sotuma
- leader aluminium, expert menuiserie
- spécialiste volets, professionnel climatisation

### Long-Tail Keywords
- meilleur fabricant aluminium sfax
- prix menuiserie aluminium sfax
- devis volet roulant sfax
- installation climatisation sfax
- réparation chauffage sfax
- isolation maison sfax
- menuiserie sur mesure sfax
- porte blindée sfax
- fenêtre sécurisée sfax
- véranda aluminium sfax
- pergola sfax, store banne sfax
- brise soleil sfax, grille protection sfax
- moustiquaire sfax, porte garage sfax
- clôture sfax, portail automatique sfax
- domotique maison sfax, automatisation maison sfax

## 🔧 Technical Implementation

### Meta Tags Structure
```html
<!-- Basic SEO -->
<meta name="description" content="...">
<meta name="keywords" content="...">
<meta name="author" content="SOTUMA">
<meta name="robots" content="index, follow">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:title" content="...">
<meta property="og:description" content="...">
<meta property="og:url" content="...">
<meta property="og:image" content="...">

<!-- Twitter Cards -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="...">
<meta name="twitter:description" content="...">
<meta name="twitter:image" content="...">

<!-- Canonical URL -->
<link rel="canonical" href="...">
```

### Structured Data (JSON-LD)
```json
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "SOTUMA",
  "url": "https://sotuma.com",
  "logo": "https://sotuma.com/images/sotuma-logo.png",
  "description": "...",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Adresse SOTUMA",
    "addressLocality": "Sfax",
    "addressCountry": "TN"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+216-XX-XXX-XXX",
    "contactType": "customer service"
  }
}
```

## 📊 Page-Specific SEO

### Homepage
- **Title**: "SOTUMA - Leader Menuiserie Aluminium Sfax | Volets Roulants, Portes, Fenêtres"
- **Priority**: 1.0
- **Keywords**: Primary brand and service keywords

### About Page
- **Title**: "À Propos de SOTUMA - Expertise Menuiserie Aluminium Sfax"
- **Focus**: Company expertise and history

### Contact Page
- **Title**: "Contact SOTUMA Sfax - Devis Gratuit Menuiserie Aluminium"
- **Focus**: Contact information and call-to-action

### Product Pages
- **Title**: "[Product Name] - SOTUMA Sfax | Menuiserie Aluminium"
- **Focus**: Product-specific keywords and features

### Project Pages
- **Title**: "[Project Name] - Projet SOTUMA | Menuiserie Aluminium Sfax"
- **Focus**: Portfolio and case studies

## 🛠️ Setup Instructions

### 1. Google Tag Manager
Replace `GTM-XXXXXXX` with your actual GTM container ID in:
- `resources/views/frontend/layouts/head.blade.php` (line 11)
- `resources/views/frontend/layouts/master.blade.php` (line 9)

### 2. Update Contact Information
Update the structured data in `SeoService.php`:
- Phone number
- Address
- Social media URLs

### 3. Test Sitemap
Visit `/sitemap.xml` to verify the sitemap is generating correctly.

### 4. Submit to Search Engines
- Submit sitemap to Google Search Console
- Submit sitemap to Bing Webmaster Tools
- Verify robots.txt is accessible at `/robots.txt`

## 📈 SEO Best Practices Implemented

✅ **Technical SEO**
- XML sitemap with proper structure
- Robots.txt with clear directives
- Canonical URLs to prevent duplicate content
- Proper meta tags structure

✅ **Content SEO**
- 150+ targeted keywords
- Page-specific meta descriptions
- Optimized titles for each page type
- Structured data for rich snippets

✅ **Local SEO**
- Location-based keywords (Sfax, Tunisia)
- Local business structured data
- Contact information optimization

✅ **Mobile SEO**
- Responsive meta viewport
- Mobile-friendly structured data
- Optimized for mobile search

✅ **Social Media SEO**
- Open Graph tags for Facebook
- Twitter Card optimization
- Social media integration

## 🎯 Expected Results

With this comprehensive SEO setup, SOTUMA can expect:
- Better search engine visibility
- Improved local search rankings
- Enhanced social media sharing
- Better user experience
- Increased organic traffic
- Higher conversion rates

## 📞 Next Steps

1. **Replace GTM ID** with actual Google Tag Manager container
2. **Update contact details** in structured data
3. **Submit sitemap** to search engines
4. **Monitor performance** using Google Analytics
5. **Regular updates** to keywords and content
6. **Track rankings** for target keywords

---

**Created by**: AI Assistant  
**Date**: October 2025  
**Version**: 1.0
