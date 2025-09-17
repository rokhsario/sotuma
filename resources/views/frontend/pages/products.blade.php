@extends('frontend.layouts.master')
@section('title', '{{ __('frontend.products') }}')
@section('main-content')
<style>
body, .aluprof-category-grid, .aluprof-category-block, .aluprof-heading, .aluprof-subheading {
    font-family: 'Calibri', Arial, sans-serif !important;
}
.aluprof-bg {
    min-height: 100vh;
    width: 100vw;
    left: 0; top: 0;
    position: absolute;
    z-index: 0;
    background: linear-gradient(120deg, #D2B48C 0%, #fffbe6 40%, #f3f3f3 100%);
    background-size: 200% 200%;
    animation: bgMove 18s ease-in-out infinite;
}
@keyframes bgMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
.aluprof-heading {
    position: relative;
    z-index: 2;
    text-align: center;
    margin-top: 32px;
    margin-bottom: 38px;
    color: #820403;
    font-size: 2.7rem;
    font-weight: 900;
    letter-spacing: 1.2px;
    text-shadow: 0 2px 16px rgba(130,4,3,0.07);
    line-height: 1.1;
    animation: fadeInDown 0.7s cubic-bezier(.4,1.4,.6,1) 0.1s both;
}
.aluprof-subheading {
    text-align: center;
    color: #a97c0e;
    font-size: 1.25rem;
    font-weight: 400;
    margin-bottom: 18px;
    opacity: 0.85;
    animation: fadeInDown 0.7s cubic-bezier(.4,1.4,.6,1) 0.2s both;
}
@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
}
.aluprof-category-outer {
    position: relative;
    z-index: 2;
    padding-bottom: 60px;
}
:root {
    --aluprof-gap-desktop: 56px;
    --aluprof-gap-tablet: 32px;
    --aluprof-gap-mobile: 16px;
    --aluprof-block-radius: 28px;
    --aluprof-img-aspect: 1.38/1;
    --aluprof-title-size: 1.65rem;
    --aluprof-title-size-tablet: 1.22rem;
    --aluprof-title-size-mobile: 1.08rem;
    --aluprof-block-padding: 44px 0 36px 0;
    --aluprof-block-padding-tablet: 28px 0 18px 0;
    --aluprof-block-padding-mobile: 14px 0 10px 0;
}
.aluprof-category-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 60px;
    margin: 70px 0 110px 0;
    padding: 0;
    justify-content: center;
    position: relative;
    z-index: 2;
    animation: fadeInGrid 1.1s cubic-bezier(.4,1.4,.6,1) 0.1s both;
}
@keyframes fadeInGrid {
    from { opacity: 0; transform: translateY(40px) scale(0.98); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}
.aluprof-category-block {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    background: rgba(255,255,255,0.82);
    border-radius: var(--aluprof-block-radius);
    overflow: hidden;
    cursor: pointer;
    text-decoration: none;
    transition: box-shadow 0.28s, transform 0.28s, background 0.22s;
    position: relative;
    border: none;
    box-shadow: 0 2px 24px 0 rgba(130,4,3,0.07), 0 1.5px 6px 0 rgba(0,0,0,0.03);
    min-height: 420px;
    outline: none;
    padding: var(--aluprof-block-padding);
    margin: 0;
    backdrop-filter: blur(7px) saturate(1.15);
    will-change: transform, box-shadow;
    opacity: 0.98;
}
.aluprof-category-block:focus {
    box-shadow: 0 0 0 5px #d4af37, 0 10px 36px 0 rgba(130,4,3,0.13);
    z-index: 3;
}
.aluprof-category-block:focus-visible {
    outline: none;
}
.aluprof-category-block:focus,
.aluprof-category-block:hover {
    z-index: 2;
    transform: translateY(-10px) scale(1.045);
    box-shadow: 0 18px 48px 0 rgba(130,4,3,0.16), 0 2.5px 12px 0 rgba(0,0,0,0.07);
    background: rgba(255,255,255,0.93);
    opacity: 1;
}
.aluprof-category-img-wrapper {
    width: 100%;
    aspect-ratio: var(--aluprof-img-aspect);
    background: #f3f3f3;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
    transition: box-shadow 0.22s;
    border-radius: calc(var(--aluprof-block-radius) - 6px);
    margin-bottom: 36px;
    will-change: transform;
}
.aluprof-category-block:hover .aluprof-category-img-wrapper::after,
.aluprof-category-block:focus .aluprof-category-img-wrapper::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg,rgba(130,4,3,0.10) 0%,rgba(212,175,55,0.08) 100%);
    pointer-events: none;
    transition: background 0.22s;
}
.aluprof-category-block:hover img,
.aluprof-category-block:focus img {
    transform: scale(1.10) rotate(-1.5deg);
    filter: brightness(0.97) contrast(1.13) saturate(1.08);
    transition: transform 0.32s cubic-bezier(.4,1.4,.6,1), filter 0.22s;
}
.aluprof-category-img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.22s, filter 0.22s;
    border-radius: 0;
    will-change: transform;
}
.aluprof-category-arrow {
    position: absolute;
    bottom: 38px;
    right: 38px;
    background: rgba(255,255,255,0.99);
    color: #820403;
    border-radius: 50%;
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.7rem;
    box-shadow: 0 2px 12px rgba(130,4,3,0.13);
    opacity: 0;
    transform: translateY(18px) scale(0.97);
    transition: opacity 0.22s, transform 0.22s;
    pointer-events: none;
    will-change: transform;
}
.aluprof-category-block:hover .aluprof-category-arrow,
.aluprof-category-block:focus .aluprof-category-arrow {
    opacity: 1;
    transform: translateY(0) scale(1.08) rotate(8deg);
    animation: wiggle 0.5s cubic-bezier(.4,1.4,.6,1) 1;
}
@keyframes wiggle {
    0% { transform: scale(1.08) rotate(0deg); }
    30% { transform: scale(1.13) rotate(12deg); }
    60% { transform: scale(1.08) rotate(-7deg); }
    100% { transform: scale(1.08) rotate(8deg); }
}
.aluprof-category-title {
    font-size: var(--aluprof-title-size);
    font-weight: 900;
    color: #820403;
    margin: 22px 0 12px 0;
    letter-spacing: 1.1px;
    transition: color 0.18s;
    line-height: 1.18;
    text-shadow: 0 2px 16px rgba(130,4,3,0.07);
}
.aluprof-category-block:hover .aluprof-category-title,
.aluprof-category-block:focus .aluprof-category-title {
    color: #d4af37;
}
.aluprof-category-desc {
    font-size: 1.13rem;
    color: #555;
    margin-bottom: 16px;
    min-height: 2.1em;
    opacity: 0.88;
    line-height: 1.5;
    font-weight: 400;
}
@media (max-width: 1300px) {
    .aluprof-category-grid {
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: var(--aluprof-gap-tablet);
        padding: 0 12px;
    }
    .aluprof-category-block {
        min-height: 270px;
        padding: var(--aluprof-block-padding-tablet);
    }
    .aluprof-category-img-wrapper {
        margin-bottom: 18px;
    }
    .aluprof-category-title {
        font-size: var(--aluprof-title-size-tablet);
    }
    .aluprof-category-arrow {
        width: 38px; height: 38px; font-size: 1.1rem; bottom: 16px; right: 16px;
    }
}
@media (max-width: 800px) {
    .aluprof-category-grid {
        grid-template-columns: 1fr 1fr;
        gap: var(--aluprof-gap-mobile);
        padding: 0 2px;
    }
    .aluprof-category-block {
        min-height: 170px;
        padding: var(--aluprof-block-padding-mobile);
    }
    .aluprof-category-img-wrapper {
        margin-bottom: 8px;
    }
    .aluprof-category-title {
        font-size: var(--aluprof-title-size-mobile);
    }
    .aluprof-category-arrow {
        width: 26px; height: 26px; font-size: 0.95rem; bottom: 7px; right: 7px;
    }
}
</style>
<div class="aluprof-bg"></div>
<div class="aluprof-heading">{{ __('frontend.products') }}</div>
                <div class="aluprof-subheading">{{ __('frontend.discover_product_range') }}</div>
<div class="aluprof-category-outer">
    <div class="aluprof-category-grid">
        @forelse($categories as $cat)
            <a href="{{ route('categories.show', $cat->slug ?? Str::slug($cat->title)) }}" class="aluprof-category-block" tabindex="0" aria-label="Voir les produits de {{ $cat->title }}">
                <div class="aluprof-category-img-wrapper">
                    <img src="{{ $cat->image ? asset($cat->image) : asset('images/no-image.png') }}" alt="{{ $cat->title }}">
                    <span class="aluprof-category-arrow" aria-hidden="true">
                        <svg width="36" height="36" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11" cy="11" r="11" fill="none"/>
                            <path d="M8 11H14M14 11L11 8M14 11L11 14" stroke="#820403" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </div>
                <div class="aluprof-category-title">{{ $cat->title }}</div>
                @if(!empty($cat->description))
                    <div class="aluprof-category-desc">{{ \Illuminate\{{ __('frontend.support') }}\Str::limit(strip_tags($cat->description), 60) }}</div>
                @endif
            </a>
        @empty
            <div class="col-12 text-center text-muted" style="grid-column: 1/-1; padding: 110px 0;">
                <img src="{{ asset('images/no-image.png') }}" alt="No categories" style="width:120px;opacity:0.5;margin-bottom:28px;filter:blur(0.5px);">
                <div style="font-size:1.45rem;font-weight:900;letter-spacing:1.2px;">Aucune catégorie trouvée.<br><span style="font-size:1.1rem;font-weight:400;opacity:0.7;">Essayez d'ajouter une nouvelle catégorie pour commencer.</span></div>
            </div>
        @endforelse
    </div>
</div>
@endsection 