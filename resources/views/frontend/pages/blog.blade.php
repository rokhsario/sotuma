@extends('frontend.layouts.master')

@section('title','SOTUMA || ' . __('frontend.media') . ' Gallery')

@section('main-content')
<style>
/* Hero Section */
.tiktok-hero {
    width: 100vw;
    min-height: 320px;
    background: linear-gradient(120deg, #e8d5f2 60%, #d4a5f0 100%);
    color: #FF0000;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 64px 0 32px 0;
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
/* Responsive grid adjustments */
@media (max-width: 1400px) {
    .tiktok-feed-grid {
        grid-template-columns: repeat(6, 1fr);
    }
}

@media (max-width: 1200px) {
    .tiktok-feed-grid {
        grid-template-columns: repeat(5, 1fr);
    }
}

@media (max-width: 1000px) {
    .tiktok-feed-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (max-width: 800px) {
    .tiktok-feed-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
    .tiktok-feed-item {
        min-height: 250px;
        max-height: 400px;
    }
}

@media (max-width: 600px) {
    .tiktok-hero {
        padding: 32px 0 16px 0;
    }
    .tiktok-hero-title {
        font-size: 2rem;
    }
    .tiktok-hero-desc {
        font-size: 1rem;
    }
    .tiktok-feed-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        padding: 24px 1vw;
    }
    .tiktok-feed-item {
        min-height: 200px;
        max-height: 300px;
    }
}

/* TikTok-like grid styles */
.tiktok-feed-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr); /* 7 posts per line */
    gap: 24px;
    margin: 0;
    width: 100vw;
    max-width: 100vw;
    padding: 48px 2vw 48px 2vw;
}
.tiktok-feed-item {
    position: relative;
    overflow: hidden;
    border-radius: 20px;
    background: #181818;
    cursor: pointer;
    aspect-ratio: 4/5;
    box-shadow: 0 8px 32px rgba(0,0,0,0.22);
    transition: transform 0.2s;
    display: flex;
    align-items: stretch;
    justify-content: stretch;
    min-height: 300px;
    max-height: 500px;
}
.tiktok-feed-item:hover {
    transform: scale(1.045);
    z-index: 2;
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
.tiktok-feed-thumb, .tiktok-feed-video {
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
    transition: opacity 0.2s;
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
}
@media (max-width: 900px) {
    .tiktok-feed-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
        padding: 24px 1vw 24px 1vw;
    }
    .tiktok-feed-item {
        min-height: 340px;
        border-radius: 14px;
    }
    .tiktok-feed-thumb, .tiktok-feed-video {
        border-radius: 14px;
    }
}
@media (max-width: 600px) {
    .tiktok-feed-grid {
        grid-template-columns: 1fr;
        gap: 10px;
        padding: 12px 0;
    }
    .tiktok-feed-item {
        min-height: 220px;
        border-radius: 8px;
    }
    .tiktok-feed-thumb, .tiktok-feed-video {
        border-radius: 8px;
    }
    .tiktok-feed-badge {
        top: 10px;
        left: 10px;
        font-size: 0.95rem;
        padding: 6px 12px;
        border-radius: 8px;
    }
    .tiktok-feed-overlay {
        padding: 10px;
        font-size: 1rem;
    }
}
.tiktok-empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 400px;
    color: #888;
    font-size: 1.5rem;
    padding: 60px 0;
    width: 100vw;
}
.tiktok-empty-state i {
    font-size: 4rem;
    margin-bottom: 18px;
    color: #ccc;
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
    console.log('Modal displayed with content:', content);
}
function closeFeedModal() {
    document.getElementById('feedModal').style.display = 'none';
    document.getElementById('feedModalContent').innerHTML = '';
    document.getElementById('feedModalTitle').innerText = '';
}
document.getElementById('feedModal').addEventListener('click', function(e) {
    if (e.target === this) closeFeedModal();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeFeedModal();
});

// Ensure autoplay for all videos in the grid after DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.tiktok-feed-video').forEach(function(video) {
        video.play().catch(() => {}); // try to autoplay, ignore errors
    });
});
</script>
@endsection

