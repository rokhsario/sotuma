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



/* ENHANCED SLIDER - SENIOR DEVELOPER LEVEL */
.enhanced-slider-section {
    position: relative;
    background: #fff;
    padding: 0 80px;
    margin: 0 auto;
    max-width: 1400px;
}

.slider-wrapper {
    position: relative;
    width: 100%;
}

/* Main Slider Container - BIGGER SIZE */
.main-slider-container {
    position: relative;
    width: 100%;
    height: 900px;
    overflow: hidden;
    border-radius: 20px;
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.2);
    background: #000;
    margin-bottom: 40px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.main-slider-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 35px 100px rgba(0, 0, 0, 0.3);
}

.slider-track {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
}

.slide.active {
    opacity: 1;
}

.slide-image-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.slide-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: zoom-in;
    display: block;
}

.slide:hover .slide-image {
    transform: scale(1.02);
}

/* Zoom Icon Overlay */
.slide::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    background: rgba(0, 0, 0, 0.7);
    border-radius: 50%;
    opacity: 0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 15;
    pointer-events: none;
}

.slide::before {
    content: '🔍';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 32px;
    color: #fff;
    opacity: 0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 16;
    pointer-events: none;
}

.slide:hover::after {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1.1);
}

.slide:hover::before {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1.1);
}

.slide-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
    color: #fff;
    padding: 40px;
    z-index: 10;
}

.slide-content {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.slide-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 15px 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.7);
    line-height: 1.2;
}

.slide-architect {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.7);
}

/* Navigation Controls */
.slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.8);
    color: #fff;
    border: none;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 20;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.slider-nav:hover {
    background: rgba(0, 0, 0, 0.95);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.4);
}

.slider-nav:active {
    transform: translateY(-50%) scale(0.95);
}

.prev-btn {
    left: 30px;
}

.next-btn {
    right: 30px;
}

.slider-nav:disabled {
    opacity: 0.3;
    cursor: not-allowed;
    transform: translateY(-50%);
}

/* Image Counter */
.image-counter {
    position: absolute;
    bottom: 30px;
    right: 30px;
    background: rgba(0, 0, 0, 0.8);
    color: #fff;
    padding: 12px 20px;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
    z-index: 20;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.current-slide {
    color: #fff;
}

.separator {
    margin: 0 8px;
    opacity: 0.7;
}

.total-slides {
    opacity: 0.7;
}

/* Progress Bar */
.progress-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: rgba(255, 255, 255, 0.2);
    z-index: 20;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #a47557, #8b5a3c);
    width: 0%;
    transition: width 0.3s ease;
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
    flex: 0 0 300px !important;
    height: 180px !important;
    border-radius: 8px !important;
    overflow: hidden !important;
    cursor: pointer !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    border: 3px solid transparent !important;
    box-shadow: var(--shadow-light) !important;
    position: relative !important;
    user-select: none !important;
    -webkit-user-select: none !important;
    -moz-user-select: none !important;
    -ms-user-select: none !important;
}

.thumbnail-item:active {
    transform: scale(0.98) !important;
}

.thumbnail-item:hover {
    transform: translateY(-3px) scale(1.02) !important;
    box-shadow: var(--shadow-medium) !important;
    border-color: var(--secondary-color) !important;
}

.thumbnail-item.active {
    border-color: var(--accent-color) !important;
    box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.2) !important;
    transform: translateY(-3px) scale(1.02) !important;
}

.thumbnail-item img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    object-position: center !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
    display: block !important;
}

.thumbnail-item:hover img {
    transform: scale(1.05) !important;
}

/* Enhanced thumbnail loading states */
.thumbnail-item.loading {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%) !important;
    background-size: 200% 100% !important;
    animation: loading 1.5s infinite !important;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* ENHANCED THUMBNAIL NAVIGATION */
.thumbnail-navigation {
    position: relative;
    background: #fff;
    padding: 20px 0;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.thumbnail-container {
    display: flex;
    gap: 15px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 10px 0;
    justify-content: center;
    align-items: center;
    position: relative;
}

.thumbnail-container::-webkit-scrollbar {
    display: none;
}

.thumbnail-item {
    flex: 0 0 200px;
    height: 120px;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 3px solid transparent;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    position: relative;
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
}

.thumbnail-item:active {
    transform: scale(0.95);
}

.thumbnail-item:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    border-color: #a47557;
}

.thumbnail-item.active {
    border-color: #a47557;
    box-shadow: 0 0 0 3px rgba(164, 117, 87, 0.3);
    transform: translateY(-5px) scale(1.02);
}

/* Thumbnail Drag and Drop Styles */
.thumbnail-sort-handle {
    position: absolute;
    top: 5px;
    left: 5px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 5px;
    border-radius: 4px;
    cursor: move;
    z-index: 10;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.sortable-thumbnail:hover .thumbnail-sort-handle {
    opacity: 1;
}

.sortable-thumbnail.ui-sortable-helper {
    transform: rotate(5deg) scale(1.1);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    z-index: 1000;
    cursor: move;
}

.sortable-thumbnails .ui-sortable-placeholder {
    background: #f0f0f0;
    border: 2px dashed #ccc;
    border-radius: 12px;
    height: 120px;
    width: 200px;
    flex: 0 0 200px;
}

.thumbnail-image-container {
    width: 100%;
    height: 100%;
    overflow: hidden;
    position: relative;
}

.thumbnail-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: block;
}

.thumbnail-item:hover .thumbnail-image {
    transform: scale(1.1);
}

.thumbnail-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
    color: #fff;
    padding: 8px 12px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.thumbnail-item:hover .thumbnail-overlay {
    opacity: 1;
}

.thumbnail-title {
    font-size: 0.8rem;
    font-weight: 600;
    text-align: center;
    line-height: 1.2;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.7);
}

/* Thumbnail Navigation Arrows */
.thumbnail-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9);
    color: #333;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 10;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
}

.thumbnail-nav:hover {
    background: rgba(255, 255, 255, 1);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

.prev-thumb {
    left: 20px;
}

.next-thumb {
    right: 20px;
}

.thumbnail-nav:disabled {
    opacity: 0.3;
    cursor: not-allowed;
    transform: translateY(-50%);
}

/* ENHANCED IMAGE MODAL */
.enhanced-image-modal {
    display: none !important;
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    z-index: 9999 !important;
    animation: modalFadeIn 0.3s ease-out !important;
    background: rgba(0, 0, 0, 0.9) !important;
}

.enhanced-image-modal.show {
    display: block !important;
    opacity: 1 !important;
}

.modal-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(10px);
}

.modal-container {
    position: relative;
    width: 95%;
    height: 95%;
    max-width: 1200px;
    max-height: 800px;
    margin: 2.5% auto;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.3);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    animation: modalSlideIn 0.3s ease-out;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 30px;
    border-bottom: 1px solid #e9ecef;
    background: #fff;
}

.modal-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
    margin: 0;
}

.close-modal {
    background: none;
    border: none;
    color: #666;
    cursor: pointer;
    padding: 8px;
    border-radius: 8px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.close-modal:hover {
    background: #f8f9fa;
    color: #333;
    transform: scale(1.1);
}

.modal-body {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    background: #f8f9fa;
    overflow: hidden;
}

.modal-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease;
}

.modal-image:hover {
    transform: scale(1.02);
}

/* Modal Navigation Buttons */
.modal-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.8);
    color: #fff;
    border: none;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 20;
    backdrop-filter: blur(10px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    opacity: 0.7;
}

.modal-nav:hover {
    background: rgba(0, 0, 0, 0.95);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.4);
    opacity: 1;
}

.modal-nav:active {
    transform: translateY(-50%) scale(0.95);
}

.prev-modal {
    left: 30px;
}

.next-modal {
    right: 30px;
}

.modal-nav:disabled {
    opacity: 0.3;
    cursor: not-allowed;
    transform: translateY(-50%);
}

/* Modal Image Counter */
.modal-counter {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 0, 0, 0.8);
    color: #fff;
    padding: 12px 20px;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
    z-index: 20;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    gap: 8px;
}

.modal-current {
    color: #fff;
    font-weight: 700;
}

.modal-separator {
    opacity: 0.7;
}

.modal-total {
    opacity: 0.7;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    padding: 20px 30px;
    border-top: 1px solid #e9ecef;
    background: #fff;
}

.modal-btn {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.modal-btn.primary {
    background: linear-gradient(135deg, #a47557, #8b5a3c);
    color: #fff;
    box-shadow: 0 4px 15px rgba(164, 117, 87, 0.3);
}

.modal-btn.primary:hover {
    background: linear-gradient(135deg, #8b5a3c, #a47557);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(164, 117, 87, 0.4);
}

.modal-btn.secondary {
    background: #f8f9fa;
    color: #666;
    border: 1px solid #dee2e6;
}

.modal-btn.secondary:hover {
    background: #e9ecef;
    color: #333;
    transform: translateY(-1px);
}

@keyframes modalFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes modalSlideIn {
    from { 
        opacity: 0;
        transform: scale(0.9) translateY(-20px);
    }
    to { 
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

/* Responsive Modal */
@media (max-width: 768px) {
    .modal-container {
        width: 98%;
        height: 98%;
        margin: 1% auto;
    }
    
    .modal-header {
        padding: 15px 20px;
    }
    
    .modal-title {
        font-size: 1.2rem;
    }
    
    .modal-footer {
        padding: 15px 20px;
        flex-direction: column;
    }
    
    .modal-btn {
        width: 100%;
        margin: 5px 0;
    }
    
    .modal-nav {
        width: 50px;
        height: 50px;
    }
    
    .prev-modal {
        left: 15px;
    }
    
    .next-modal {
        right: 15px;
    }
    
    .modal-counter {
        bottom: 20px;
        padding: 10px 16px;
        font-size: 0.9rem;
    }
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
    /* Tablet Breadcrumb */
    .breadcrumb-container {
        padding: 0 40px !important;
    }
    
    /* Tablet Slider */
    .enhanced-slider-section {
        padding: 0 40px !important;
    }
    
    .main-slider-container {
        height: 600px !important;
        border-radius: 15px !important;
    }
    
    .slider-nav {
        width: 50px !important;
        height: 50px !important;
        font-size: 18px !important;
    }
    
    .slider-nav.prev {
        left: 20px !important;
    }
    
    .slider-nav.next {
        right: 20px !important;
    }
    
    .thumbnail-item {
        flex: 0 0 150px !important;
        height: 100px !important;
    }
    
    /* Tablet Project Info */
    .project-info-container {
        grid-template-columns: 1fr !important;
        gap: 25px !important;
        padding: 0 40px !important;
    }
    
    .project-info-card {
        padding: 25px !important;
    }
}

@media (max-width: 768px) {
    /* Breadcrumb Mobile */
    .breadcrumb-container {
        padding: 0 20px !important;
    }
    
    .breadcrumb {
        font-size: 0.9rem !important;
        gap: 8px !important;
    }
    
    /* Slider Section Mobile */
    .enhanced-slider-section {
        padding: 0 !important;
        margin: 0 !important;
    }
    
    .main-slider-container {
        height: 400px !important;
        border-radius: 0 !important;
        margin-bottom: 20px !important;
        width: 100vw !important;
        max-width: 100vw !important;
        margin-left: calc(-50vw + 50%) !important;
        margin-right: calc(-50vw + 50%) !important;
    }
    
    .slider-nav {
        width: 40px !important;
        height: 40px !important;
        font-size: 16px !important;
    }
    
    .slider-nav.prev {
        left: 10px !important;
    }
    
    .slider-nav.next {
        right: 10px !important;
    }
    
    .image-counter {
        bottom: 15px !important;
        right: 15px !important;
        padding: 6px 12px !important;
        font-size: 0.75rem !important;
    }
    
    /* Thumbnail Navigation Mobile */
    .thumbnail-navigation {
        padding: 15px 0 !important;
        margin: 0 20px !important;
    }
    
    .thumbnail-container {
        gap: 10px !important;
        padding: 5px 0 !important;
    }
    
    .thumbnail-item {
        flex: 0 0 120px !important;
        height: 80px !important;
        border-radius: 8px !important;
    }
    
    .thumbnail-nav {
        width: 30px !important;
        height: 30px !important;
        font-size: 12px !important;
    }
    
    .prev-thumb {
        left: 10px !important;
    }
    
    .next-thumb {
        right: 10px !important;
    }
    
    /* Project Info Mobile */
    .project-info-container {
        padding: 0 20px !important;
        margin: 20px 0 !important;
    }
    
    .project-info-card {
        padding: 20px !important;
        margin-bottom: 15px !important;
    }
    
    .project-info-card h3 {
        font-size: 1.1rem !important;
        margin-bottom: 15px !important;
    }
    
    .project-info-card p {
        font-size: 0.9rem !important;
        line-height: 1.5 !important;
    }
}

@media (max-width: 480px) {
    /* Breadcrumb Small Mobile */
    .breadcrumb-container {
        padding: 0 15px !important;
    }
    
    .breadcrumb {
        font-size: 0.8rem !important;
        gap: 6px !important;
        flex-wrap: wrap !important;
    }
    
    /* Slider Section Small Mobile */
    .main-slider-container {
        height: 350px !important;
        border-radius: 0 !important;
        margin-bottom: 15px !important;
    }
    
    .slider-nav {
        width: 35px !important;
        height: 35px !important;
        font-size: 14px !important;
    }
    
    .slider-nav.prev {
        left: 8px !important;
    }
    
    .slider-nav.next {
        right: 8px !important;
    }
    
    .image-counter {
        bottom: 12px !important;
        right: 12px !important;
        padding: 4px 8px !important;
        font-size: 0.7rem !important;
    }
    
    /* Thumbnail Navigation Small Mobile */
    .thumbnail-navigation {
        padding: 10px 0 !important;
        margin: 0 15px !important;
    }
    
    .thumbnail-container {
        gap: 8px !important;
        padding: 3px 0 !important;
    }
    
    .thumbnail-item {
        flex: 0 0 100px !important;
        height: 70px !important;
        border-radius: 6px !important;
    }
    
    .thumbnail-nav {
        width: 25px !important;
        height: 25px !important;
        font-size: 10px !important;
    }
    
    .prev-thumb {
        left: 8px !important;
    }
    
    .next-thumb {
        right: 8px !important;
    }
    
    /* Project Info Small Mobile */
    .project-info-container {
        padding: 0 15px !important;
        margin: 15px 0 !important;
    }
    
    .project-info-card {
        padding: 15px !important;
        margin-bottom: 12px !important;
    }
    
    .project-info-card h3 {
        font-size: 1rem !important;
        margin-bottom: 12px !important;
    }
    
    .project-info-card p {
        font-size: 0.85rem !important;
        line-height: 1.4 !important;
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



<!-- ENHANCED PROJECT SLIDER - SENIOR DEVELOPER LEVEL -->
<section class="enhanced-slider-section">
    <div class="slider-wrapper">
        <!-- Main Slider Container -->
        <div class="main-slider-container" id="mainSlider">
            <div class="slider-track" id="sliderTrack">
        @if($project->image)
                    <div class="slide active" data-index="0" onclick="openModalWithIndex(0, '{{ asset($project->image) }}', '{{ $project->title }}')">
                        <div class="slide-image-container">
            <img src="{{ asset($project->image) }}" 
                 alt="{{ $project->title }}" 
                                 class="slide-image"
                                 loading="lazy">
                        </div>
                        <div class="slide-overlay">
                            <div class="slide-content">
                                <h3 class="slide-title">{{ $project->title }}</h3>
                                @if($project->architect)
                                    <p class="slide-architect">Architecte: {{ $project->architect }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @php $galleryIndex = 0; @endphp
                @foreach($project->images as $index => $image)
                    @if($project->image !== $image->image)
                        <div class="slide {{ $galleryIndex === 0 && !$project->image ? 'active' : '' }}" 
                             data-index="{{ $project->image ? $galleryIndex + 1 : $galleryIndex }}"
                             onclick="openModalWithIndex({{ $project->image ? $galleryIndex + 1 : $galleryIndex }}, '{{ asset($image->image) }}', '{{ $project->title }}')">
                            <div class="slide-image-container">
                                <img src="{{ asset($image->image) }}" 
                     alt="{{ $project->title }}" 
                                     class="slide-image"
                                     loading="lazy">
                            </div>
                            <div class="slide-overlay">
                                <div class="slide-content">
                                    <h3 class="slide-title">{{ $project->title }}</h3>
                                    @if($project->architect)
                                        <p class="slide-architect">Architecte: {{ $project->architect }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @php $galleryIndex++; @endphp
                    @else
                        <!-- Skipping duplicate image: {{ $image->image }} -->
                    @endif
                @endforeach
            </div>
            
            <!-- Navigation Controls -->
            <button class="slider-nav prev-btn" id="prevBtn" aria-label="Previous image">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
        </button>
            <button class="slider-nav next-btn" id="nextBtn" aria-label="Next image">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
        </button>
        
        <!-- Image Counter -->
        <div class="image-counter" id="imageCounter">
                <span class="current-slide">1</span>
                <span class="separator">/</span>
                <span class="total-slides">{{ $project->images->count() + ($project->image ? 1 : 0) }}</span>
        </div>
            
            <!-- Progress Bar -->
            <div class="progress-bar">
                <div class="progress-fill" id="progressFill"></div>
    </div>
        </div>
        
        <!-- Thumbnail Navigation -->
        <div class="thumbnail-navigation">
            @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin'))
            <div class="alert alert-info mb-3">
                <i class="fas fa-info-circle"></i>
                <strong>Mode Admin:</strong> Vous pouvez glisser-déposer les images pour les réorganiser.
            </div>
            @endif
            <div class="thumbnail-container {{ auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin') ? 'sortable-thumbnails' : '' }}" id="thumbnailContainer">
                <!-- Principal image removed from thumbnails to avoid duplication -->
            @php $thumbIndex = 0; @endphp
            @foreach($project->images as $index => $image)
                @if($project->image !== $image->image)
                    <div class="thumbnail-item {{ $thumbIndex === 0 && !$project->image ? 'active' : '' }} {{ auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin') ? 'sortable-thumbnail' : '' }}" 
                         data-index="{{ $thumbIndex }}" 
                         data-image-id="{{ $image->id }}">
                        @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin'))
                        <div class="thumbnail-sort-handle">
                            <i class="fas fa-grip-vertical"></i>
                        </div>
                        @endif
                        <div class="thumbnail-image-container">
                            <img src="{{ asset($image->image) }}" 
                                 alt="{{ $project->title }}" 
                                 class="thumbnail-image"
                                 loading="lazy">
                        </div>
                        <div class="thumbnail-overlay">
                            <span class="thumbnail-title">{{ $project->title }}</span>
                        </div>
                    </div>
                    @php $thumbIndex++; @endphp
                @else
                    <!-- Skipping duplicate thumbnail: {{ $image->image }} -->
                @endif
            @endforeach
            </div>
            
            <!-- Thumbnail Navigation Arrows -->
            <button class="thumbnail-nav prev-thumb" id="prevThumbBtn" aria-label="Previous thumbnails">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <button class="thumbnail-nav next-thumb" id="nextThumbBtn" aria-label="Next thumbnails">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
    </div>
</section>

<!-- Project Info Section removed by request -->

<!-- Modal is created dynamically by JavaScript -->

<script>
// ENHANCED SLIDER - SENIOR DEVELOPER LEVEL
class ProjectSlider {
    constructor() {
        this.currentIndex = 0;
        this.isTransitioning = false;
        this.touchStartX = 0;
        this.touchEndX = 0;
        this.autoSlideInterval = null;
        this.slides = [];
        this.thumbnails = [];
        this.totalSlides = 0;
        
        this.init();
    }
    
    init() {
        this.slides = document.querySelectorAll('.slide');
        this.thumbnails = document.querySelectorAll('.thumbnail-item');
        this.totalSlides = this.slides.length;
        
        if (this.totalSlides === 0) return;
        
        this.setupEventListeners();
        this.updateSlider();
        this.startAutoSlide();
        
        console.log('Enhanced slider initialized with', this.totalSlides, 'slides');
    }
    
    setupEventListeners() {
        // Navigation buttons
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        
        if (prevBtn) prevBtn.addEventListener('click', () => this.previousSlide());
        if (nextBtn) nextBtn.addEventListener('click', () => this.nextSlide());
        
        // Thumbnail navigation
        this.thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', () => {
                // If principal image exists, add 1 to the index since principal is at index 0
                const slideIndex = @if($project->image) index + 1 @else index @endif;
                this.goToSlide(slideIndex);
            });
        });
        
        // Thumbnail scroll buttons
        const prevThumbBtn = document.getElementById('prevThumbBtn');
        const nextThumbBtn = document.getElementById('nextThumbBtn');
        
        if (prevThumbBtn) prevThumbBtn.addEventListener('click', () => this.scrollThumbnails(-1));
        if (nextThumbBtn) nextThumbBtn.addEventListener('click', () => this.scrollThumbnails(1));
        
        // Touch support
        const mainSlider = document.getElementById('mainSlider');
        if (mainSlider) {
            mainSlider.addEventListener('touchstart', (e) => this.handleTouchStart(e), { passive: true });
            mainSlider.addEventListener('touchend', (e) => this.handleTouchEnd(e), { passive: true });
            
            // Pause auto-slide on hover
            mainSlider.addEventListener('mouseenter', () => this.stopAutoSlide());
            mainSlider.addEventListener('mouseleave', () => this.startAutoSlide());
        }
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => this.handleKeyboard(e));
    }
    
    goToSlide(index) {
        if (this.isTransitioning || index === this.currentIndex || index < 0 || index >= this.totalSlides) return;
        
        this.isTransitioning = true;
        this.currentIndex = index;
        
        this.updateSlider();
        
        setTimeout(() => {
            this.isTransitioning = false;
        }, 600);
    }
    
    nextSlide() {
        const nextIndex = (this.currentIndex + 1) % this.totalSlides;
        this.goToSlide(nextIndex);
    }
    
    previousSlide() {
        const prevIndex = this.currentIndex === 0 ? this.totalSlides - 1 : this.currentIndex - 1;
        this.goToSlide(prevIndex);
    }
    
    updateSlider() {
        // Update slides
        this.slides.forEach((slide, index) => {
            slide.classList.toggle('active', index === this.currentIndex);
        });
        
        // Update thumbnails
        this.thumbnails.forEach((thumb, index) => {
            // If principal image exists, thumbnail index 0 corresponds to slide index 1
            const correspondingSlideIndex = @if($project->image) index + 1 @else index @endif;
            thumb.classList.toggle('active', correspondingSlideIndex === this.currentIndex);
            
            // Scroll to active thumbnail
            if (correspondingSlideIndex === this.currentIndex) {
                thumb.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'nearest', 
                    inline: 'center' 
                });
            }
        });
        
        // Update counter
        this.updateCounter();
        
        // Update progress bar
        this.updateProgressBar();
    }
    
    updateCounter() {
    const counter = document.getElementById('imageCounter');
    if (counter) {
            const currentSlide = counter.querySelector('.current-slide');
            if (currentSlide) {
                currentSlide.textContent = this.currentIndex + 1;
            }
            const totalSlidesEl = counter.querySelector('.total-slides');
            if (totalSlidesEl) {
                totalSlidesEl.textContent = this.totalSlides;
            }
        }
    }
    
    updateProgressBar() {
        const progressFill = document.getElementById('progressFill');
        if (progressFill) {
            const progress = ((this.currentIndex + 1) / this.totalSlides) * 100;
            progressFill.style.width = `${progress}%`;
        }
    }
    
    scrollThumbnails(direction) {
        const container = document.getElementById('thumbnailContainer');
        if (container) {
            const scrollAmount = 250 * direction;
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }
    
    handleTouchStart(e) {
        this.touchStartX = e.touches[0].clientX;
    }
    
    handleTouchEnd(e) {
        this.touchEndX = e.changedTouches[0].clientX;
        this.handleSwipe();
    }
    
    handleSwipe() {
        const swipeThreshold = 50;
        const swipeDistance = this.touchStartX - this.touchEndX;
        
        if (Math.abs(swipeDistance) > swipeThreshold) {
            if (swipeDistance > 0) {
                this.nextSlide(); // Swipe left - next slide
            } else {
                this.previousSlide(); // Swipe right - previous slide
            }
        }
    }
    
    handleKeyboard(e) {
        if (e.key === 'ArrowLeft') {
            this.previousSlide();
        } else if (e.key === 'ArrowRight') {
            this.nextSlide();
        }
    }
    
    startAutoSlide() {
        if (this.totalSlides <= 1) return;
        
        this.stopAutoSlide();
        this.autoSlideInterval = setInterval(() => {
            this.nextSlide();
        }, 5000); // Change every 5 seconds
    }
    
    stopAutoSlide() {
        if (this.autoSlideInterval) {
            clearInterval(this.autoSlideInterval);
            this.autoSlideInterval = null;
        }
    }
}

// SIMPLE MODAL FUNCTIONS
let modalCurrentIndex = 0;
let modalImages = [];

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize slider
    new ProjectSlider();
    
    // Initialize modal images array - include ALL images in the correct order
    modalImages = [];
    
    // Add principal image first (if it exists)
    @if($project->image)
        modalImages.push('{{ asset($project->image) }}');
    @endif
    
    // Then add gallery images (excluding duplicates of principal image)
    @foreach($project->images as $image)
        @if($project->image !== $image->image)
            modalImages.push('{{ asset($image->image) }}');
        @else
            console.warn('Skipping duplicate gallery image:', '{{ $image->image }}');
        @endif
    @endforeach
    
    console.log('Modal images array order:', modalImages);
    console.log('Array length:', modalImages.length);
    console.log('Principal image exists:', @if($project->image) true @else false @endif);
    console.log('Principal image path:', @if($project->image) '{{ $project->image }}' @else 'null' @endif);
    console.log('Gallery images count:', {{ $project->images->count() }});
    
    // Debug: Check if principal image is duplicated in gallery
    @if($project->image)
        @foreach($project->images as $galleryImage)
            @if($galleryImage->image === $project->image)
                console.error('DUPLICATION FOUND: Principal image also exists in gallery!');
                console.error('Principal:', '{{ $project->image }}');
                console.error('Gallery duplicate:', '{{ $galleryImage->image }}');
            @endif
        @endforeach
    @endif
});

// NEW FUNCTION - Opens modal with specific index
function openModalWithIndex(index, imageSrc, title) {
    console.log('=== OPENING MODAL ===');
    console.log('Index:', index);
    console.log('Image source:', imageSrc);
    console.log('Title:', title);
    console.log('Modal images array:', modalImages);
    console.log('Array length:', modalImages.length);
    
    // Set the current index directly
    modalCurrentIndex = index;
    
    // Remove any existing modal
    const existingModal = document.getElementById('imageModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Create new modal with the exact image and navigation
    const modalHTML = `
        <div id="imageModal" style="display: block; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; cursor: pointer;" onclick="closeModal()">
            <div style="position: relative; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; padding: 20px;">
                <button onclick="closeModal()" style="position: absolute; top: 20px; right: 20px; background: rgba(0,0,0,0.7); color: white; border: none; width: 50px; height: 50px; border-radius: 50%; cursor: pointer; font-size: 24px; z-index: 10001;">&times;</button>
                <button onclick="event.stopPropagation(); prevImage();" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.7); color: white; border: none; width: 60px; height: 60px; border-radius: 50%; cursor: pointer; font-size: 24px; z-index: 10001;">‹</button>
                <button onclick="event.stopPropagation(); nextImage();" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); background: rgba(0,0,0,0.7); color: white; border: none; width: 60px; height: 60px; border-radius: 50%; cursor: pointer; font-size: 24px; z-index: 10001;">›</button>
                <img id="modalImage" src="${imageSrc}" style="max-width: 90%; max-height: 90%; object-fit: contain; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);" alt="${title}">
                <div id="modalCounter" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); background: rgba(0,0,0,0.7); color: white; padding: 10px 20px; border-radius: 25px; font-size: 16px; font-weight: bold;">
                    <span id="modalCurrent">${modalCurrentIndex + 1}</span> / <span id="modalTotal">${modalImages.length}</span>
                </div>
            </div>
        </div>
    `;
    
    // Add to body
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    document.body.style.overflow = 'hidden';
    
    console.log('Modal opened with image at index:', modalCurrentIndex);
}

// Keep old function for compatibility
function showImage(imageSrc, title) {
    // Find the index of the clicked image
    const imageIndex = modalImages.indexOf(imageSrc);
    modalCurrentIndex = imageIndex >= 0 ? imageIndex : 0;
    openModalWithIndex(modalCurrentIndex, imageSrc, title);
}

// Keep the old function for compatibility
function openFullImage(imageSrc, title) {
    showImage(imageSrc, title);
}

// Simple navigation functions
function nextImage() {
    if (modalImages.length <= 1) return;
    
    modalCurrentIndex++;
    if (modalCurrentIndex >= modalImages.length) {
        modalCurrentIndex = 0;
    }
    
    const modalImg = document.getElementById('modalImage');
    const modalCurrent = document.getElementById('modalCurrent');
    
    if (modalImg && modalImages[modalCurrentIndex]) {
        modalImg.src = modalImages[modalCurrentIndex];
        modalImg.onload = function() {
            console.log('Image loaded successfully');
        };
        modalImg.onerror = function() {
            console.log('Image failed to load:', modalImages[modalCurrentIndex]);
        };
    }
    
    if (modalCurrent) {
        modalCurrent.textContent = modalCurrentIndex + 1;
    }
}

function prevImage() {
    if (modalImages.length <= 1) return;
    
    modalCurrentIndex--;
    if (modalCurrentIndex < 0) {
        modalCurrentIndex = modalImages.length - 1;
    }
    
    const modalImg = document.getElementById('modalImage');
    const modalCurrent = document.getElementById('modalCurrent');
    
    if (modalImg && modalImages[modalCurrentIndex]) {
        modalImg.src = modalImages[modalCurrentIndex];
        modalImg.onload = function() {
            console.log('Image loaded successfully');
        };
        modalImg.onerror = function() {
            console.log('Image failed to load:', modalImages[modalCurrentIndex]);
        };
    }
    
    if (modalCurrent) {
        modalCurrent.textContent = modalCurrentIndex + 1;
    }
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    if (modal) {
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
    }
}

function downloadImage(imageSrc, title) {
    const link = document.createElement('a');
    link.href = imageSrc;
    link.download = title ? `${title.replace(/[^a-zA-Z0-9]/g, '_')}.jpg` : 'image.jpg';
    link.target = '_blank';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// Fallback function for opening modal
function openModal(imageSrc) {
    console.log('Fallback openModal called with:', imageSrc);
    openFullImage(imageSrc, 'Image Preview');
}

// Test function to ensure modal works
function testModal() {
    console.log('Testing modal...');
    if (modalImages.length > 0) {
        openModalWithIndex(0, modalImages[0], 'Test Image');
        console.log('Modal should be visible now');
    } else {
        console.error('No images available for modal');
    }
}

// Modal click events are handled in the dynamically created modal

// Keyboard navigation for modal
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('imageModal');
    if (modal && modal.style.display === 'block') {
    if (e.key === 'Escape') {
        closeModal();
        } else if (e.key === 'ArrowLeft') {
            prevImage();
        } else if (e.key === 'ArrowRight') {
            nextImage();
        }
    }
});

// Test navigation function
function testNavigation() {
    console.log('Testing navigation...');
    console.log('Modal images:', modalImages);
    console.log('Current index:', modalCurrentIndex);
    navigateModalImage(1);
}

// Force test modal with first image
function testModalWithImage() {
    if (modalImages.length > 0) {
        console.log('Opening modal with first image:', modalImages[0]);
        openModalWithIndex(0, modalImages[0], 'Test Image');
        console.log('Modal opened with image:', modalImages[0]);
    } else {
        console.error('No images available in modalImages array');
    }
}

// Test navigation directly
function testNav() {
    console.log('=== TESTING NAVIGATION ===');
    console.log('Current index:', modalCurrentIndex);
    console.log('Total images:', modalImages.length);
    console.log('Available images:', modalImages);
    
    if (modalImages.length > 1) {
        console.log('Testing next navigation...');
        navigateModalImage(1);
    } else {
        console.log('Not enough images to test navigation');
    }
}

// Test modal images array
function testModalImages() {
    console.log('=== TESTING MODAL IMAGES ===');
    console.log('Modal images array:', modalImages);
    console.log('Array length:', modalImages.length);
    console.log('Current index:', modalCurrentIndex);
    
    if (modalImages.length > 0) {
        console.log('First image:', modalImages[0]);
        console.log('Last image:', modalImages[modalImages.length - 1]);
        
        // Test each image URL
        modalImages.forEach((url, index) => {
            console.log(`Image ${index}:`, url);
        });
    } else {
        console.log('No images in modalImages array!');
    }
}

// Test opening modal with specific image
function testOpenImage(index) {
    if (modalImages.length > index) {
        console.log('Opening image at index:', index);
        console.log('Image URL:', modalImages[index]);
        modalCurrentIndex = index;
        openFullImage(modalImages[index], 'Test Image');
    } else {
        console.log('Index out of range');
    }
}

// Force open modal with first image
function testFirstImage() {
    if (modalImages.length > 0) {
        console.log('Opening first image:', modalImages[0]);
        modalCurrentIndex = 0;
        openFullImage(modalImages[0], 'First Image');
    }
}


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

@push('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
// Thumbnail Drag and Drop for Admin Users
@if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin'))
$(document).ready(function() {
    // Initialize sortable for thumbnails
    $(".sortable-thumbnails").sortable({
        items: '.sortable-thumbnail',
        handle: '.thumbnail-sort-handle',
        placeholder: 'ui-sortable-placeholder',
        tolerance: 'pointer',
        cursor: 'move',
        update: function(event, ui) {
            // Get the new order
            const imageIds = [];
            $('.sortable-thumbnail').each(function() {
                const imageId = $(this).data('image-id');
                if (imageId && imageId !== 'main') {
                    imageIds.push(imageId);
                }
            });
            
            // Save the new order via AJAX
            $.ajax({
                url: '{{ route("admin.projects.images.update-order", $project->id) }}',
                method: 'POST',
                data: {
                    images: imageIds.map((id, index) => ({
                        id: parseInt(id),
                        sort_order: index
                    })),
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    showNotification('Ordre des images mis à jour avec succès!', 'success');
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    showNotification('Erreur lors de la mise à jour des images', 'error');
                }
            });
        }
    });

    // Prevent click on sort handle from triggering thumbnail click
    $('.thumbnail-sort-handle').on('click', function(e) {
        e.stopPropagation();
    });
});

// Function to show notifications
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
    notification.style.position = 'fixed';
    notification.style.top = '20px';
    notification.style.right = '20px';
    notification.style.zIndex = '9999';
    notification.innerHTML = `
        ${message}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
@endif
</script>

<script>
// Force mobile responsive grids immediately
document.addEventListener('DOMContentLoaded', function() {
    function forceMobileGrids() {
        const isMobile = window.innerWidth <= 768;
        const projectGrid = document.querySelector('.project-info-container');
        
        if (isMobile && projectGrid) {
            projectGrid.style.gridTemplateColumns = '1fr';
            projectGrid.style.gap = '20px';
            projectGrid.setAttribute('data-mobile-forced', 'true');
        }
    }
    
    // Run immediately
    forceMobileGrids();
    
    // Run on resize
    window.addEventListener('resize', forceMobileGrids);
    
    // Run every 100ms for first 3 seconds to catch any late-loading content
    let interval = setInterval(forceMobileGrids, 100);
    setTimeout(() => clearInterval(interval), 3000);
});
</script>
@endpush 