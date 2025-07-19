@extends('frontend.layouts.master')
@section('title','SOTUMA')
@section('main-content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-image">
        <img src="https://www.archpaper.com/wp-content/uploads/2021/06/c-Kevin-Scott-UW-Hans-Rosling-Center-13-scaled.jpg" alt="Modern Building Facade">
                    </div>
    <div class="hero-content">
        <h1>SOTUMA POUR LE DÉVELOPPEMENT</h1>
    </div>
</section>

<!-- Highlights from About Us -->
<section class="home-about-highlight section">
    <div class="container">
        <h2 class="section-title">À propos de SOTUMA</h2>
        @include('frontend.pages.about-us-highlight')
    </div>
</section>

<!-- Our Projects Section -->
<section class="home-projects section">
    <div class="container">
        <h2 class="section-title">Nos Projets</h2>
        @include('frontend.pages.projects-highlight')
    </div>
</section>

<!-- Our Products Section -->
<section class="home-products section">
    <div class="container">
        <h2 class="section-title">Nos Produits</h2>
        @include('frontend.pages.products-highlight')
    </div>
</section>

<!-- Certificates Section -->
<section class="home-certificates section">
    <div class="container">
        <h2 class="section-title">Nos Certificats</h2>
        @include('frontend.pages.certificates-highlight')
    </div>
</section>
@endsection
