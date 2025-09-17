@extends('frontend.layouts.master')

@section('title', $project->title . ' - ' . __('frontend.projects'))

@section('main-content')

<style>
/* Modern Project Detail Page - Full Width Slider */
:root {
    --primary-color: #2c3e50;
    --primary-dark: #1a252f;
    --secondary-color: #3498db;
    --accent-color: #e74c3c;
    --text-primary: #2c3e50;
    --text-secondary: #7f8c8d;
    --background-light: #f8f9fa;
    --white: #ffffff;
    --shadow-light: 0 2px 8px rgba(0,0,0,0.1);
    --shadow-medium: 0 4px 16px rgba(0,0,0,0.15);
    --shadow-heavy: 0 8px 32px rgba(0,0,0,0.2);
    --border-radius: 12px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Breadcrumb */
.breadcrumb-section {
    background: #fff;
    padding: 25px 0;
    border-bottom: 1px solid #e9ecef;
    box-shadow: var(--shadow-light);
}

.breadcrumb-container {
    max-width: 100%;
    margin: 0 auto;
    padding: 0 80px;
}

.breadcrumb {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1rem;
    color: var(--text-secondary);
    flex-wrap: wrap;
}

.breadcrumb a {
    color: var(--secondary-color);
    text-decoration: none;
    transition: var(--transition);
    font-weight: 500;
}

.breadcrumb a:hover {
    color: var(--primary-color);
    text-decoration: underline;
}

.breadcrumb .separator {
    color: #ccc;
    font-weight: 300;
}



/* Main Image Slider - Full Width */
.main-slider-section {
    position: relative;
    background: #fff;
    overflow: hidden;
    padding: 0 80px;
}

.main-slider-container {
    position: relative;
    width: 100%;
    height: 700px;
    overflow: hidden;
}

.main-slider-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
    cursor: zoom-in;
}

.main-slider-image:hover {
    transform: scale(1.02);
}

/* Navigation Arrows */
.slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border: none;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    z-index: 10;
    backdrop-filter: blur(10px);
}

.slider-nav:hover {
    background: rgba(0, 0, 0, 0.9);
    transform: translateY(-50%) scale(1.1);
}

.slider-nav.prev {
    left: 30px;
}

.slider-nav.next {
    right: 30px;
}

.slider-nav:disabled {
    opacity: 0.3;
    cursor: not-allowed;
}

/* Image Counter */
.image-counter {
    position: absolute;
    bottom: 30px;
    right: 30px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 500;
    backdrop-filter: blur(10px);
    z-index: 10;
}

/* Thumbnail Slider - Full Width */
.thumbnail-slider-section {
    background: #fff;
    padding: 30px 0;
    border-bottom: 1px solid #e9ecef;
}

.thumbnail-slider-container {
    max-width: 100%;
    margin: 0 auto;
    padding: 0 80px;
    position: relative;
}

.thumbnail-slider {
    display: flex;
    gap: 15px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 10px 0;
    scrollbar-width: none;
    -ms-overflow-style: none;
    justify-content: center;
    align-items: center;
}

.thumbnail-slider::-webkit-scrollbar {
    display: none;
}

.thumbnail-item {
    flex: 0 0 300px;
    height: 180px;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    transition: var(--transition);
    border: 3px solid transparent;
    box-shadow: var(--shadow-light);
    position: relative;
}

.thumbnail-item:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-medium);
    border-color: var(--secondary-color);
}

.thumbnail-item.active {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.2);
}

.thumbnail-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.thumbnail-item:hover img {
    transform: scale(1.05);
}

/* Thumbnail Navigation */
.thumbnail-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    z-index: 10;
    backdrop-filter: blur(10px);
}

.thumbnail-nav:hover {
    background: rgba(0, 0, 0, 0.9);
    transform: translateY(-50%) scale(1.1);
}

.thumbnail-nav.prev {
    left: 10px;
}

.thumbnail-nav.next {
    right: 10px;
}

.thumbnail-nav:disabled {
    opacity: 0.3;
    cursor: not-allowed;
}

/* Project Info Section */
.project-info-section {
    background: #fff;
    padding: 60px 0;
}

.project-info-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 80px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
}

.project-info-card {
    background: var(--background-light);
    padding: 30px;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-light);
    border: 1px solid #e9ecef;
}

.project-info-card h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 20px 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    border-bottom: 2px solid var(--secondary-color);
    padding-bottom: 10px;
}

.project-info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.project-info-list li {
    padding: 12px 0;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.project-info-list li:last-child {
    border-bottom: none;
}

.project-info-list .label {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.95rem;
}

.project-info-list .value {
    color: var(--text-secondary);
    font-size: 0.95rem;
    text-align: right;
    max-width: 60%;
}

.project-description {
    background: var(--background-light);
    padding: 30px;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-light);
    border: 1px solid #e9ecef;
}

.project-description h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 20px 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    border-bottom: 2px solid var(--secondary-color);
    padding-bottom: 10px;
}

.project-description p {
    font-size: 1rem;
    color: var(--text-secondary);
    line-height: 1.7;
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Image Gallery Modal */
.image-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.95);
    backdrop-filter: blur(5px);
}

.modal-content {
    position: relative;
    margin: auto;
    display: block;
    width: 95%;
    max-width: 1400px;
    height: 95%;
    top: 50%;
    transform: translateY(-50%);
}

.modal-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.close-modal {
    position: absolute;
    top: 20px;
    right: 30px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
    z-index: 10000;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
}

.close-modal:hover {
    background: rgba(0, 0, 0, 0.8);
    transform: scale(1.1);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .project-info-container {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}

@media (max-width: 768px) {
    
    .main-slider-container {
        height: 500px;
    }
    
    .slider-nav {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    
    .slider-nav.prev {
        left: 15px;
    }
    
    .slider-nav.next {
        right: 15px;
    }
    
    .image-counter {
        bottom: 20px;
        right: 20px;
        padding: 8px 16px;
        font-size: 0.8rem;
    }
    
    .thumbnail-item {
        flex: 0 0 200px;
        height: 120px;
    }
    
    .project-info-container {
        padding: 0 20px;
    }
}

@media (max-width: 480px) {
    
    .main-slider-container {
        height: 400px;
    }
    
    .slider-nav {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
    
    .thumbnail-item {
        flex: 0 0 120px;
        height: 80px;
    }
    
    .project-info-container {
        padding: 0 15px;
    }
}
</style>

<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="breadcrumb-container">
        <nav class="breadcrumb">
                            <a href="{{ route('home') }}">{{ __('frontend.home') }}</a>
            <span class="separator">/</span>
                            <a href="{{ route('project-categories.index') }}">{{ __('frontend.project_categories') }}</a>
            <span class="separator">/</span>
            @if($project->category)
                <a href="{{ route('project-categories.show', $project->category->slug) }}">{{ $project->category->name }}</a>
                <span class="separator">/</span>
            @endif
            <span>{{ $project->title }}</span>
        </nav>
    </div>
</section>



<!-- Main Image Slider -->
<section class="main-slider-section">
    <div class="main-slider-container">
        @if($project->image)
            <img src="{{ asset($project->image) }}" 
                 alt="{{ $project->title }}" 
                 class="main-slider-image"
                 id="mainSliderImage"
                 onclick="openModal(this.src)">
        @else
            <img src="{{ asset('images/10.png') }}" 
                 alt="{{ $project->title }}" 
                 class="main-slider-image"
                 id="mainSliderImage">
        @endif
        
        <!-- Navigation Arrows -->
        <button class="slider-nav prev" onclick="changeMainImage(-1)" id="prevBtn">
            ‹
        </button>
        <button class="slider-nav next" onclick="changeMainImage(1)" id="nextBtn">
            ›
        </button>
        
        <!-- Image Counter -->
        <div class="image-counter" id="imageCounter">
            1 / {{ $project->images->count() > 0 ? $project->images->count() : 1 }}
        </div>
    </div>
</section>

<!-- Thumbnail Slider -->
@if($project->images->count() > 1)
<section class="thumbnail-slider-section">
    <div class="thumbnail-slider-container">
        <button class="thumbnail-nav prev" onclick="scrollThumbnails(-1)" id="thumbPrevBtn">
            ‹
        </button>
        <button class="thumbnail-nav next" onclick="scrollThumbnails(1)" id="thumbNextBtn">
            ›
        </button>
        
        <div class="thumbnail-slider" id="thumbnailSlider">
            @foreach($project->images as $index => $image)
                <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" 
                     onclick="selectMainImage({{ $index }}, '{{ asset($image->image) }}')">
                    <img src="{{ asset($image->image) }}" alt="{{ $project->title }}">
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Project Info Section -->
<section class="project-info-section">
    <div class="project-info-container">
        <!-- Project Details -->
        <div class="project-info-card">
            <h3>Détails du Projet</h3>
            <ul class="project-info-list">
                @if($project->category)
                    <li>
                        <span class="label">Catégorie</span>
                        <span class="value">{{ $project->category->name }}</span>
                    </li>
                @endif
                
                @if($project->location)
                    <li>
                        <span class="label">Localisation</span>
                        <span class="value">{{ $project->location }}</span>
                    </li>
                @endif
                
                @if($project->client)
                    <li>
                        <span class="label">Client</span>
                        <span class="value">{{ $project->client }}</span>
                    </li>
                @endif
                
                @if($project->completion_date)
                    <li>
                        <span class="label">Date de réalisation</span>
                        <span class="value">{{ $project->completion_date }}</span>
                    </li>
                @endif
                
                @if($project->architect)
                    <li>
                        <span class="label">Architecte</span>
                        <span class="value">{{ $project->architect }}</span>
                    </li>
                @endif
            </ul>
        </div>
        
        <!-- Project Description -->
        @if($project->description)
            <div class="project-description">
                <h3>Description du Projet</h3>
                <p>{!! nl2br(e($project->description)) !!}</p>
            </div>
        @endif
    </div>
</section>

<!-- Image Modal -->
<div id="imageModal" class="image-modal">
    <span class="close-modal" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

<script>
let currentImageIndex = 0;
const projectImages = [
    @if($project->image)
        '{{ asset($project->image) }}',
    @endif
    @foreach($project->images as $image)
        '{{ asset($image->image) }}',
    @endforeach
];

function changeMainImage(direction) {
    if (projectImages.length <= 1) return;
    
    currentImageIndex += direction;
    
    if (currentImageIndex >= projectImages.length) {
        currentImageIndex = 0;
    } else if (currentImageIndex < 0) {
        currentImageIndex = projectImages.length - 1;
    }
    
    updateMainImage();
    updateThumbnails();
    updateCounter();
}

function selectMainImage(index, imageSrc) {
    currentImageIndex = index;
    updateMainImage();
    updateThumbnails();
    updateCounter();
}

function updateMainImage() {
    const mainImage = document.getElementById('mainSliderImage');
    if (mainImage && projectImages[currentImageIndex]) {
        mainImage.src = projectImages[currentImageIndex];
    }
}

function updateThumbnails() {
    document.querySelectorAll('.thumbnail-item').forEach((item, index) => {
        item.classList.toggle('active', index === currentImageIndex);
    });
}

function updateCounter() {
    const counter = document.getElementById('imageCounter');
    if (counter) {
        counter.textContent = `${currentImageIndex + 1} / ${projectImages.length}`;
    }
}

function scrollThumbnails(direction) {
    const slider = document.getElementById('thumbnailSlider');
    const scrollAmount = 300 * direction;
    slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
}

function openModal(imageSrc) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modal.style.display = 'block';
    modalImg.src = imageSrc;
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside the image
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Keyboard navigation for main slider
document.addEventListener('keydown', function(e) {
    if (e.key === 'ArrowLeft') {
        changeMainImage(-1);
    } else if (e.key === 'ArrowRight') {
        changeMainImage(1);
    }
});
</script>

@endsection 