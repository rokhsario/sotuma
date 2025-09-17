@extends('frontend.layouts.master')

@section('title','SOTUMA || ' . ($post->title ?? __('frontend.article')))

@section('main-content')
    <!-- Hero Section -->
    <section class="blog-hero">
        <div class="hero-container">
            @if($post->images && $post->images->count() > 0)
                @php
                    $featuredImage = $post->images->first();
@endphp
                @if($featuredImage && $featuredImage->isVideo())
                    <div class="hero-video">
                        <video autoplay muted loop class="hero-video-element">
                            <source src="{{ $featuredImage->url }}" type="video/{{ $featuredImage->file_extension }}">
                            Votre navigateur ne supporte pas la lecture de vidéos.
                        </video>
                        <div class="hero-overlay"></div>
    </div>
                @elseif($featuredImage)
                    <div class="hero-image" style="background-image: url('{{ $featuredImage->url }}')">
            <div class="hero-overlay"></div>
        </div>
                @else
                    <div class="hero-image" style="background-image: url('{{ asset($post->photo) }}')">
                        <div class="hero-overlay"></div>
            </div>
                @endif
            @else
                <div class="hero-image" style="background-image: url('{{ asset($post->photo) }}')">
                    <div class="hero-overlay"></div>
            </div>
            @endif
        
            <div class="hero-content">
                <div class="hero-breadcrumb">
                    <a href="{{route('home')}}">{{ __('frontend.home') }}</a>
                    <span>/</span>
                    <a href="{{route('media')}}">{{ __('frontend.blog') }}</a>
                    <span>/</span>
                    <span>{{$post->title}}</span>
                </div>
                
                <h1 class="hero-title">{{$post->title}}</h1>
                
                <div class="hero-meta">
                    <span class="meta-item">
                            <i class="fas fa-user"></i>
                        {{$post->author_info->name ?? 'SOTUMA'}}
                    </span>
                    <span class="meta-item">
                            <i class="fas fa-calendar"></i>
                        {{$post->created_at ? $post->created_at->format('d M Y') : '15 Jan 2024'}}
                    </span>
                    <span class="meta-item">
                            <i class="fas fa-folder"></i>
                        {{$post->cat_info->title ?? __('frontend.category') }}
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="blog-content">
        <div class="content-container">
            <div class="content-layout">
                <!-- Left Side - Post Media -->
                <div class="post-media">
                                            @if($post->images && $post->images->count() > 0)
                        @php
                            $featuredImage = $post->images->first();
                        @endphp
                        @if($featuredImage && $featuredImage->isVideo())
                            <div class="media-video">
                                <video autoplay muted loop playsinline class="post-video">
                                    <source src="{{ $featuredImage->url }}" type="video/{{ $featuredImage->file_extension }}">
                                    Votre navigateur ne supporte pas la lecture de vidéos.
                                </video>
                            </div>
                        @elseif($featuredImage)
                            <div class="media-image">
                                <img src="{{ $featuredImage->url }}" alt="{{ $post->title }}" class="post-image">
                            </div>
                        @endif
                    @else
                        <div class="media-image">
                            <img src="{{ asset($post->photo) }}" alt="{{$post->title}}" class="post-image">
                        </div>
                    @endif
                </div>

                <!-- Right Side - Post Content -->
                <div class="post-content">
                    <div class="content-header">
                        <h2 class="post-title">{{$post->title}}</h2>
                        <p class="post-summary">{{$post->summary}}</p>
                            </div>
                            
                    <div class="content-body">
                                {!! $post->description !!}
                            </div>
                            
                            @if($post->tags)
                        <div class="content-tags">
                                    <h4>{{ __('frontend.tags') }}:</h4>
                            <div class="tags-list">
                                        @foreach(explode(',', $post->tags) as $tag)
                                            <span class="tag">{{ trim($tag) }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                                            </div>
                                            </div>
    </section>
                    
                    <!-- Comments Section -->
    <section class="comments-section">
        <div class="comments-container">
            <h3>{{ __('frontend.comments') }} ({{$post->allComments ? $post->allComments->count() : rand(0, 15)}})</h3>
                        
                        @auth
                            <div class="comment-form-container">
                    <h4>{{ __('frontend.leave_comment') }}</h4>
                                <form class="comment-form" action="{{route('post-comment.store',$post->slug)}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                            <textarea name="comment" id="comment" rows="5" placeholder="{{ __('frontend.share_thoughts') }}" required></textarea>
                                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                        <input type="hidden" name="parent_id" id="parent_id" value="" />
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="submit-btn">
                                <span class="comment-btn comment">{{ __('frontend.post_comment') }}</span>
                                <span class="comment-btn reply" style="display: none;">{{ __('frontend.reply_comment') }}</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="login-prompt">
                    <p>{{ __('frontend.login_to_comment') }} <a href="{{route('login.form')}}">{{ __('frontend.login') }}</a> ou <a href="{{route('register.form')}}">{{ __('frontend.register') }}</a>.</p>
                            </div>
                        @endauth
                        
                        <!-- Comments List -->
                        <div class="comments-list">
                            @include('frontend.pages.comment', ['comments' => $post->comments, 'post_id' => $post->id, 'depth' => 3])
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
/* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
    color: #333;
    background-color: #fafafa;
}

/* Hero Section */
.blog-hero {
    position: relative;
    height: 60vh;
    min-height: 500px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero-container {
    position: relative;
    width: 100%;
    height: 100%;
}

.hero-video,
.hero-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.hero-video-element {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 100%);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

.hero-breadcrumb {
    margin-bottom: 20px;
    font-size: 14px;
    opacity: 0.9;
}

.hero-breadcrumb a {
    color: white;
    text-decoration: none;
    transition: opacity 0.3s ease;
}

.hero-breadcrumb a:hover {
    opacity: 0.8;
}

.hero-breadcrumb span {
    margin: 0 10px;
    opacity: 0.7;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 30px;
    line-height: 1.2;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.hero-meta {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
    font-size: 14px;
    opacity: 0.9;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.meta-item i {
    font-size: 16px;
}

/* Main Content Section */
.blog-content {
    padding: 80px 0;
    background: white;
}

.content-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.content-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: start;
}

/* Post Media */
.post-media {
    position: sticky;
    top: 100px;
}

.media-video,
.media-image {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.post-video,
.post-image {
    width: 100%;
    height: auto;
    display: block;
}

.post-video {
    min-height: 400px;
    object-fit: cover;
}

/* Post Content */
.post-content {
    padding-left: 20px;
}

.content-header {
    margin-bottom: 40px;
}

.post-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    line-height: 1.3;
    color: #2c3e50;
}

.post-summary {
    font-size: 1.2rem;
    color: #666;
    line-height: 1.6;
    margin-bottom: 0;
}

.content-body {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #444;
    margin-bottom: 40px;
}

.content-body h2,
.content-body h3,
.content-body h4 {
    color: #2c3e50;
    margin-top: 30px;
    margin-bottom: 15px;
    font-weight: 600;
}

.content-body h2 {
    font-size: 1.8rem;
}

.content-body h3 {
    font-size: 1.5rem;
}

.content-body h4 {
    font-size: 1.3rem;
}

.content-body p {
    margin-bottom: 20px;
}

.content-body ul,
.content-body ol {
    margin-bottom: 20px;
    padding-left: 30px;
}

.content-body li {
    margin-bottom: 8px;
}

.content-body blockquote {
    border-left: 4px solid #D2B48C;
    padding-left: 20px;
    margin: 30px 0;
    font-style: italic;
    color: #666;
    background: #f8f9fa;
    padding: 20px;
    border-radius: 0 8px 8px 0;
}

.content-body strong {
    color: #2c3e50;
    font-weight: 600;
}

.content-tags {
    padding-top: 30px;
    border-top: 1px solid #eee;
}

.content-tags h4 {
    margin-bottom: 15px;
    color: #2c3e50;
    font-size: 1.1rem;
}

.tags-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tag {
    background: #f8f9fa;
    color: #666;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.tag:hover {
    background: #D2B48C;
    color: white;
    border-color: #D2B48C;
}

/* Comments Section */
.comments-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.comments-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 20px;
}

.comments-section h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 40px;
    color: #2c3e50;
    text-align: center;
}

.comment-form-container {
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    margin-bottom: 40px;
}

.comment-form-container h4 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #2c3e50;
}

.comment-form .form-group {
    margin-bottom: 20px;
}

.comment-form textarea {
    width: 100%;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 15px;
    font-size: 1rem;
    resize: vertical;
    transition: border-color 0.3s ease;
    font-family: inherit;
}

.comment-form textarea:focus {
    outline: none;
    border-color: #D2B48C;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
}

.submit-btn {
    background: #D2B48C;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.submit-btn:hover {
    background: #e6b842;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(210, 180, 140, 0.3);
}

.login-prompt {
    text-align: center;
    padding: 40px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    margin-bottom: 40px;
}

.login-prompt a {
    color: #D2B48C;
    text-decoration: none;
    font-weight: 600;
}

.login-prompt a:hover {
    text-decoration: underline;
}

.comments-list {
    background: white;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    overflow: hidden;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .content-layout {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .post-media {
        position: static;
    }
    
    .post-content {
        padding-left: 0;
    }
    
    .hero-title {
        font-size: 2.8rem;
    }
}

@media (max-width: 768px) {
    .blog-hero {
        height: 50vh;
        min-height: 400px;
    }
    
    .hero-title {
        font-size: 2.2rem;
    }
    
    .hero-meta {
        gap: 20px;
    }
    
    .blog-content {
        padding: 60px 0;
    }
    
    .content-layout {
        gap: 30px;
    }
    
    .post-title {
        font-size: 2rem;
    }
    
    .comments-section {
        padding: 60px 0;
    }
    
    .comment-form-container {
        padding: 30px 20px;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 1.8rem;
    }
    
    .hero-meta {
    flex-direction: column;
    gap: 15px;
}

    .post-title {
        font-size: 1.6rem;
    }
    
    .content-body {
        font-size: 1rem;
    }
    
    .comment-form-container {
        padding: 20px 15px;
    }
    
    .submit-btn {
    width: 100%;
    }
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Focus styles for accessibility */
button:focus,
textarea:focus,
input:focus {
    outline: 2px solid #D2B48C;
    outline-offset: 2px;
}

/* Loading animation for images */
.post-image {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.post-image.loaded {
    opacity: 1;
}

/* Hover effects */
.post-media:hover .post-image,
.post-media:hover .post-video {
    transform: scale(1.02);
    transition: transform 0.3s ease;
}

/* Print styles */
@media print {
    .blog-hero {
        height: auto;
        min-height: auto;
    }
    
    .hero-overlay {
        background: rgba(0,0,0,0.3);
    }
    
    .comments-section {
        display: none;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Image loading animation
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.post-image');
    
    images.forEach(img => {
        if (img.complete) {
            img.classList.add('loaded');
    } else {
            img.addEventListener('load', function() {
                this.classList.add('loaded');
            });
        }
    });
});

    // Comment functionality
$(document).ready(function() {
    $('.btn-reply.reply').click(function(e){
        e.preventDefault();
        $('.btn-reply.reply').show();
        $('.comment_btn.comment').hide();
        $('.comment_btn.reply').show();
        $(this).hide();
        $('.btn-reply.cancel').hide();
        $(this).siblings('.btn-reply.cancel').show();
        
        var parent_id = $(this).data('id');
        var html = $('#commentForm');
        $(html).find('#parent_id').val(parent_id);
        $('#commentFormContainer').hide();
        $(this).parents('.comment-list').append(html).fadeIn('slow').addClass('appended');
    });

    $('.btn-reply.cancel').click(function(e){
        e.preventDefault();
        $('.btn-reply.reply').show();
        $('.btn-reply.cancel').hide();
        $('.comment_btn.comment').show();
        $('.comment_btn.reply').hide();
        $('#commentFormContainer').show();
        $('#commentForm').removeClass('appended');
    });
});
</script>
@endpush