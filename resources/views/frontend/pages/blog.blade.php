@extends('frontend.layouts.master')

@section('title','SOTUMA || ' . __('frontend.media') . ' Gallery')

@section('main-content')
<style>
/* ===== MEDIA PAGE MOBILE RESPONSIVE STYLES ===== */

/* Hero Section */
.tiktok-hero {
    width: 100%;
    min-height: 320px;
    background: linear-gradient(120deg, #e8d5f2 60%, #d4a5f0 100%);
    color: #FF0000;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 64px 20px 32px 20px;
    margin-bottom: 0;
    position: relative;
    overflow: hidden;
}

.tiktok-hero-title {
    font-size: 3.2rem;
    font-weight: 900;
    letter-spacing: -1px;
    margin-bottom: 18px;
    text-shadow: 0 4px 24px rgba(255, 0, 0, 0.3);
    color: #FF0000;
    text-align: center;
}

.tiktok-hero-desc {
    font-size: 1.35rem;
    font-weight: 400;
    opacity: 0.92;
    max-width: 700px;
    text-align: center;
    margin-bottom: 0;
    color: #FF0000;
}

/* TikTok-like grid styles */
.tiktok-feed-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 24px;
    margin: 0;
    width: 100%;
    max-width: 100%;
    padding: 48px 20px;
    box-sizing: border-box;
}

.tiktok-feed-item {
    position: relative;
    overflow: hidden;
    border-radius: 20px;
    background: #181818;
    cursor: pointer;
    aspect-ratio: 4/5;
    box-shadow: 0 8px 32px rgba(0,0,0,0.22);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    align-items: stretch;
    justify-content: stretch;
    min-height: 300px;
    max-height: 500px;
}

.tiktok-feed-item:hover {
    transform: scale(1.045);
    z-index: 2;
    box-shadow: 0 12px 40px rgba(0,0,0,0.3);
}

/* Touch feedback for mobile */
.tiktok-feed-item:active {
    transform: scale(0.98);
    transition: transform 0.1s ease;
}

/* Different hover effects for clickable vs view-only items */
.tiktok-feed-item[onclick]:hover {
    transform: scale(1.045);
    box-shadow: 0 12px 40px rgba(0,0,0,0.3);
}

.tiktok-feed-item[onclick]:hover .tiktok-feed-badge {
    background: rgba(255, 255, 255, 0.95);
    color: #333;
}

/* Visual indicator for view-only items */
.tiktok-feed-item[onclick] .tiktok-feed-badge {
    background: rgba(0, 0, 0, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.tiktok-feed-thumb, 
.tiktok-feed-video {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    border-radius: 20px;
}

.tiktok-feed-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background: linear-gradient(0deg,rgba(0,0,0,0.7),rgba(0,0,0,0));
    color: #fff;
    padding: 22px;
    font-size: 1.25rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.tiktok-feed-item:hover .tiktok-feed-overlay {
    opacity: 1;
}

.tiktok-feed-badge {
    position: absolute;
    top: 22px;
    left: 22px;
    background: rgba(0,0,0,0.7);
    color: #fff;
    padding: 10px 18px;
    border-radius: 16px;
    font-size: 1.15rem;
    z-index: 2;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.tiktok-empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 400px;
    color: #888;
    font-size: 1.5rem;
    padding: 60px 20px;
    width: 100%;
    text-align: center;
}

.tiktok-empty-state i {
    font-size: 4rem;
    margin-bottom: 18px;
    color: #ccc;
}

/* ===== RESPONSIVE BREAKPOINTS ===== */

/* Large Desktop */
@media (max-width: 1400px) {
    .tiktok-feed-grid {
        grid-template-columns: repeat(6, 1fr);
        gap: 20px;
        padding: 40px 20px;
    }
}

/* Desktop */
@media (max-width: 1200px) {
    .tiktok-feed-grid {
        grid-template-columns: repeat(5, 1fr);
        gap: 18px;
        padding: 40px 20px;
    }
}

/* Small Desktop */
@media (max-width: 1000px) {
    .tiktok-feed-grid {
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        padding: 30px 20px;
    }
    
    .tiktok-feed-item {
        min-height: 280px;
        max-height: 400px;
    }
}

/* Tablet */
@media (max-width: 768px) {
    .tiktok-hero {
        padding: 40px 20px 20px 20px;
        min-height: 250px;
    }
    
    .tiktok-hero-title {
        font-size: 2.5rem;
        margin-bottom: 15px;
    }
    
    .tiktok-hero-desc {
        font-size: 1.1rem;
    }
    
    .tiktok-feed-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        padding: 30px 20px;
    }
    
    .tiktok-feed-item {
        min-height: 250px;
        max-height: 350px;
        border-radius: 16px;
    }
    
    .tiktok-feed-thumb, 
    .tiktok-feed-video {
        border-radius: 16px;
    }
    
    .tiktok-feed-badge {
        top: 15px;
        left: 15px;
        font-size: 1rem;
        padding: 8px 14px;
        border-radius: 12px;
    }
    
    .tiktok-feed-overlay {
        padding: 15px;
        font-size: 1.1rem;
    }
    
    .tiktok-empty-state {
        padding: 40px 20px;
        font-size: 1.3rem;
    }
    
    .tiktok-empty-state i {
        font-size: 3.5rem;
    }
}

/* Mobile */
@media (max-width: 600px) {
    .tiktok-hero {
        padding: 30px 15px 15px 15px;
        min-height: 200px;
    }
    
    .tiktok-hero-title {
        font-size: 2rem;
        margin-bottom: 12px;
    }
    
    .tiktok-hero-desc {
        font-size: 1rem;
    }
    
    .tiktok-feed-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        padding: 20px 15px;
    }
    
    .tiktok-feed-item {
        min-height: 200px;
        max-height: 300px;
        border-radius: 12px;
    }
    
    .tiktok-feed-thumb, 
    .tiktok-feed-video {
        border-radius: 12px;
    }
    
    .tiktok-feed-badge {
        top: 10px;
        left: 10px;
        font-size: 0.9rem;
        padding: 6px 10px;
        border-radius: 10px;
    }
    
    .tiktok-feed-overlay {
        padding: 12px;
        font-size: 1rem;
    }
    
    .tiktok-empty-state {
        padding: 30px 15px;
        font-size: 1.2rem;
    }
    
    .tiktok-empty-state i {
        font-size: 3rem;
    }
}

/* Small Mobile */
@media (max-width: 480px) {
    .tiktok-hero {
        padding: 25px 10px 10px 10px;
        min-height: 180px;
    }
    
    .tiktok-hero-title {
        font-size: 1.8rem;
        margin-bottom: 10px;
    }
    
    .tiktok-hero-desc {
        font-size: 0.9rem;
    }
    
    .tiktok-feed-grid {
        grid-template-columns: 1fr;
        gap: 10px;
        padding: 15px 10px;
    }
    
    .tiktok-feed-item {
        min-height: 180px;
        max-height: 250px;
        border-radius: 10px;
    }
    
    .tiktok-feed-thumb, 
    .tiktok-feed-video {
        border-radius: 10px;
    }
    
    .tiktok-feed-badge {
        top: 8px;
        left: 8px;
        font-size: 0.8rem;
        padding: 5px 8px;
        border-radius: 8px;
    }
    
    .tiktok-feed-overlay {
        padding: 10px;
        font-size: 0.9rem;
    }
    
    .tiktok-empty-state {
        padding: 25px 10px;
        font-size: 1.1rem;
    }
    
    .tiktok-empty-state i {
        font-size: 2.5rem;
    }
}

/* ===== MODAL RESPONSIVENESS ===== */
@media (max-width: 768px) {
    #feedModal {
        padding: 10px;
    }
    
    #feedModal span {
        top: 5px;
        right: 10px;
        font-size: 2rem;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0,0,0,0.7);
        border-radius: 50%;
    }
    
    #feedModalContent video,
    #feedModalContent img {
        max-width: 95vw;
        max-height: 80vh;
        border-radius: 16px;
    }
    
    #feedModalTitle {
        margin-top: 15px;
        font-size: 1.1rem;
        padding: 0 10px;
    }
}

@media (max-width: 480px) {
    #feedModal {
        padding: 5px;
    }
    
    #feedModal span {
        top: 5px;
        right: 5px;
        font-size: 1.8rem;
        width: 35px;
        height: 35px;
    }
    
    #feedModalContent video,
    #feedModalContent img {
        max-width: 98vw;
        max-height: 75vh;
        border-radius: 12px;
    }
    
    #feedModalTitle {
        font-size: 1rem;
        margin-top: 10px;
    }
}

/* ===== TOUCH OPTIMIZATIONS ===== */
@media (hover: none) and (pointer: coarse) {
    .tiktok-feed-item:hover {
        transform: none;
    }
    
    .tiktok-feed-item:active {
        transform: scale(0.95);
    }
    
    .tiktok-feed-overlay {
        opacity: 1;
        background: linear-gradient(0deg,rgba(0,0,0,0.8),rgba(0,0,0,0.3));
    }
}

/* ===== ACCESSIBILITY IMPROVEMENTS ===== */
.tiktok-feed-item:focus {
    outline: 2px solid #007bff;
    outline-offset: 2px;
}

.tiktok-feed-item[tabindex] {
    cursor: pointer;
}

/* ===== PERFORMANCE OPTIMIZATIONS ===== */
.tiktok-feed-thumb,
.tiktok-feed-video {
    will-change: transform;
}

@media (prefers-reduced-motion: reduce) {
    .tiktok-feed-item {
        transition: none;
    }
    
    .tiktok-feed-item:hover {
        transform: none;
    }
    
    .tiktok-feed-overlay {
        transition: none;
    }
}
</style>

<div class="tiktok-hero">
    <div class="tiktok-hero-title">Médias &amp; Actualités</div>
</div>

@if($posts->count())
<div class="tiktok-feed-grid">
    @foreach($posts as $post)
        @php
            // Use post_images relationship or fallback to photo field
            $postImage = $post->images && $post->images->count() > 0 ? $post->images->first() : null;
            $mediaUrl = $postImage ? asset($postImage->image) : ($post->photo ? asset($post->photo) : asset('images/blog/' . $post->getBlogImageAttribute()));
            
            // Detect if it's a video based on file extension
            $isVideo = false;
            $mediaType = 'image';
            if ($postImage) {
                $isVideo = $postImage->isVideo();
                $mediaType = $postImage->media_type;
            } elseif ($post->photo) {
                $extension = strtolower(pathinfo($post->photo, PATHINFO_EXTENSION));
                $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv', '3gp', 'm4v'];
                $isVideo = in_array($extension, $videoExtensions);
                $mediaType = $isVideo ? 'video' : 'image';
            }
        @endphp
        @php
            // Check if post has description or summary for clickable behavior
            $hasDescription = !empty(trim($post->description)) || !empty(trim($post->summary));
            // Debug: Log the description status
            // echo "<!-- Post ID: {$post->id}, Description: '" . trim($post->description) . "', Summary: '" . trim($post->summary) . "', HasDescription: " . ($hasDescription ? 'true' : 'false') . " -->";
        @endphp
        
        @if($hasDescription)
            <a href="{{ route('media.detail', $post->slug) }}" class="tiktok-feed-item" style="text-decoration:none;" data-id="{{ $post->id }}">
        @else
            <div class="tiktok-feed-item" style="text-decoration:none; cursor: pointer;" data-id="{{ $post->id }}" onclick="console.log('Clicking modal for post {{ $post->id }}'); openFeedModal({{ $post->id }}); return false;">
        @endif
            @if($isVideo)
                <video class="tiktok-feed-video" src="{{ $mediaUrl }}" muted loop playsinline preload="metadata"></video>
                <div class="tiktok-feed-badge">
                    <i class="fas fa-video"></i> Vidéo
                    @if(!$hasDescription)
                        <i class="fas fa-expand ml-1" style="font-size: 0.8em;"></i>
                        <span style="font-size: 0.7em; margin-left: 4px;">Modal</span>
                    @else
                        <span style="font-size: 0.7em; margin-left: 4px;">Detail</span>
                    @endif
                </div>
            @else
                <img class="tiktok-feed-thumb" src="{{ $mediaUrl }}" alt="Media">
                <div class="tiktok-feed-badge">
                    <i class="fas fa-image"></i> Image
                    @if(!$hasDescription)
                        <i class="fas fa-expand ml-1" style="font-size: 0.8em;"></i>
                        <span style="font-size: 0.7em; margin-left: 4px;">Modal</span>
                    @else
                        <span style="font-size: 0.7em; margin-left: 4px;">Detail</span>
                    @endif
                </div>
            @endif
            <div class="tiktok-feed-overlay">
                <div>{{ $post->title }}</div>
                @if(!$hasDescription)
                    <div style="font-size: 0.8em; opacity: 0.8; margin-top: 4px;">
                        <i class="fas fa-eye"></i> Cliquez pour agrandir
                    </div>
                @endif
            </div>
        @if($hasDescription)
            </a>
        @else
            </div>
        @endif
    @endforeach
</div>
@else
<div class="tiktok-empty-state">
    <i class="fas fa-photo-video"></i>
    <div>Aucun contenu disponible pour le moment.<br><small>Revenez bientôt pour découvrir nos actualités et médias !</small></div>
</div>
@endif

<!-- Modal for previewing post/video -->
<div id="feedModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.92); z-index:9999; align-items:center; justify-content:center;">
    <div style="position:relative; max-width:99vw; max-height:99vh;">
        <span onclick="closeFeedModal()" style="position:absolute; top:10px; right:20px; color:#fff; font-size:2.5rem; cursor:pointer; z-index:2;">&times;</span>
        <div id="feedModalContent"></div>
        <div id="feedModalTitle" style="color:#fff; margin-top:24px; text-align:center; font-size:1.4rem;"></div>
    </div>
</div>

<script>
const postsData = @json($posts->values());

// Mobile detection
const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;

function openFeedModal(id) {
    console.log('Opening modal for post ID:', id);
    const post = postsData.find(p => p.id === id);
    if (!post) {
        console.log('Post not found in data');
        return;
    }
    console.log('Post found:', post);
    
    // Check if post has images and detect video type
    let mediaUrl = '';
    let isVideo = false;
    
    if (post.images && post.images.length > 0) {
        const postImage = post.images[0];
        mediaUrl = '{{ asset('') }}' + postImage.image;
        // Check if it's a video based on file extension
        const extension = postImage.image.split('.').pop().toLowerCase();
        const videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv', '3gp', 'm4v'];
        isVideo = videoExtensions.includes(extension);
    } else if (post.photo) {
        mediaUrl = '{{ asset('') }}' + post.photo;
        // Check if it's a video based on file extension
        const extension = post.photo.split('.').pop().toLowerCase();
        const videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv', '3gp', 'm4v'];
        isVideo = videoExtensions.includes(extension);
    } else {
        mediaUrl = '{{ asset('images/herroooo.jpg') }}';
    }
    
    let content = '';
    if (isVideo) {
        content = `<video src="${mediaUrl}" controls autoplay loop playsinline style="max-width:96vw; max-height:96vh; border-radius:24px; background:#000;"></video>
                   <div style="position: absolute; top: 20px; left: 20px; background: rgba(0,0,0,0.7); color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.9rem;">
                       <i class="fas fa-volume-up"></i> Son activé
                   </div>`;
    } else {
        content = `<img src="${mediaUrl}" style="max-width:96vw; max-height:96vh; border-radius:24px; background:#000;" />`;
    }
    
    document.getElementById('feedModalContent').innerHTML = content;
    document.getElementById('feedModalTitle').innerText = post.title;
    document.getElementById('feedModal').style.display = 'flex';
    
    // Prevent body scroll on mobile
    document.body.style.overflow = 'hidden';
    
    console.log('Modal displayed with content:', content);
}

function closeFeedModal() {
    document.getElementById('feedModal').style.display = 'none';
    document.getElementById('feedModalContent').innerHTML = '';
    document.getElementById('feedModalTitle').innerText = '';
    
    // Restore body scroll
    document.body.style.overflow = '';
}

// Enhanced modal interactions
document.getElementById('feedModal').addEventListener('click', function(e) {
    if (e.target === this) closeFeedModal();
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeFeedModal();
});

// Touch interactions for mobile
if (isTouch) {
    // Add touch feedback to feed items
    document.querySelectorAll('.tiktok-feed-item').forEach(item => {
        item.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
            this.style.transition = 'transform 0.1s ease';
        });
        
        item.addEventListener('touchend', function() {
            this.style.transform = '';
        });
        
        item.addEventListener('touchcancel', function() {
            this.style.transform = '';
        });
    });
    
    // Swipe to close modal
    let startY = 0;
    let currentY = 0;
    let isDragging = false;
    
    document.getElementById('feedModal').addEventListener('touchstart', function(e) {
        startY = e.touches[0].clientY;
        isDragging = true;
    });
    
    document.getElementById('feedModal').addEventListener('touchmove', function(e) {
        if (!isDragging) return;
        
        currentY = e.touches[0].clientY;
        const diffY = currentY - startY;
        
        if (diffY > 100) { // Swipe down threshold
            closeFeedModal();
            isDragging = false;
        }
    });
    
    document.getElementById('feedModal').addEventListener('touchend', function() {
        isDragging = false;
    });
}

// Ensure autoplay for all videos in the grid after DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Lazy load videos for better performance
    const videoObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const video = entry.target;
                video.play().catch(() => {
                    // Autoplay failed, that's okay
                    console.log('Video autoplay failed for:', video.src);
                });
                videoObserver.unobserve(video);
            }
        });
    }, {
        rootMargin: '50px 0px',
        threshold: 0.1
    });
    
    document.querySelectorAll('.tiktok-feed-video').forEach(video => {
        videoObserver.observe(video);
    });
    
    // Add loading states for images
    document.querySelectorAll('.tiktok-feed-thumb').forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '1';
        });
        
        img.addEventListener('error', function() {
            this.src = '{{ asset('images/no-image.png') }}';
        });
    });
    
    // Performance optimization: Reduce animations on low-end devices
    if (navigator.hardwareConcurrency && navigator.hardwareConcurrency < 4) {
        document.documentElement.style.setProperty('--animation-duration', '0.2s');
    }
});

// Handle orientation change
window.addEventListener('orientationchange', function() {
    setTimeout(function() {
        // Close modal on orientation change to prevent layout issues
        if (document.getElementById('feedModal').style.display === 'flex') {
            closeFeedModal();
        }
    }, 100);
});

// Handle resize events
let resizeTimeout;
window.addEventListener('resize', function() {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(function() {
        // Adjust modal content on resize
        const modal = document.getElementById('feedModal');
        if (modal.style.display === 'flex') {
            const content = modal.querySelector('#feedModalContent');
            if (content) {
                const video = content.querySelector('video');
                const img = content.querySelector('img');
                
                if (video) {
                    video.style.maxWidth = '96vw';
                    video.style.maxHeight = '96vh';
                }
                if (img) {
                    img.style.maxWidth = '96vw';
                    img.style.maxHeight = '96vh';
                }
            }
        }
    }, 250);
});
</script>
@endsection

