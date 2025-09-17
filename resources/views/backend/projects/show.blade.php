@extends('backend.layouts.master')
@section('title','Détail du projet')
@section('main-content')
<style>
/* Gallery Overlay Styles */
.gallery-overlay {
    transition: opacity 0.3s ease;
}

.gallery-content {
    transition: transform 0.3s ease;
}

/* Navigation buttons */
#overlayPrevBtn, #overlayNextBtn {
    background: rgba(255,255,255,0.1);
    border: 2px solid rgba(255,255,255,0.3);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

#overlayPrevBtn:hover, #overlayNextBtn:hover {
    background: rgba(255,255,255,0.2);
    border-color: rgba(255,255,255,0.5);
    transform: scale(1.1);
}

/* Image hover effects */
.gallery-img:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Détail du projet</h6>
                    <div>
                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary btn-sm">Retour</a>
                    </div>
                </div>
                <div class="card-body">
                    <h3>{{ $project->title }}</h3>
                    <p><strong>Catégorie:</strong> {{ $project->category->name ?? '-' }}</p>
                    <p><strong>Description:</strong></p>
                    <div class="mb-3">{!! nl2br(e($project->description)) !!}</div>
                    <div class="mb-3">
                        <strong>Images:</strong>
                        @php
                            use Illuminate\Support\Facades\Storage;
                            $imageList = [];
                            
                            // Handle main image from projects table
                            if ($project->image) {
                                $mainUrl = asset($project->image);
                                if ($mainUrl) {
                                    $imageList[] = $mainUrl;
                                }
                            }
                            
                            // Handle images from project_images relationship
                            if (is_iterable($project->images) && count($project->images)) {
                                foreach ($project->images as $img) {
                                    if (isset($img->image)) {
                                        $imgUrl = asset($img->image);
                                        if ($imgUrl) {
                                            $imageList[] = $imgUrl;
                                        }
                                    }
                                }
                            }
                            // Handle images as string (comma-separated) - fallback
                            elseif (is_string($project->images) && trim($project->images) !== '') {
                                $paths = explode(',', $project->images);
                                foreach ($paths as $imgPath) {
                                    $imgPath = trim($imgPath);
                                    $imgUrl = asset($imgPath);
                                    if ($imgUrl) {
                                        $imageList[] = $imgUrl;
                                    }
                                }
                            }
                        @endphp

                        <div class="d-flex flex-wrap">
                            @if(count($imageList) > 0)
                                @foreach($imageList as $index => $imgUrl)
                                    <div class="position-relative m-2">
                                        <img src="{{ $imgUrl }}" 
                                             alt="Project Image" 
                                             style="max-width:200px; cursor: pointer;" 
                                             class="rounded shadow gallery-img"
                                             data-index="{{ $index }}"
                                             onclick="openImageModal({{ $index }})">
                                        @if($index === 0)
                                            <div class="position-absolute top-0 start-0 bg-primary text-white px-2 py-1 rounded" style="font-size: 0.8rem;">
                                                Image principale
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-warning">
                                    <strong>Aucune image trouvée.</strong><br>
                                    Vérifiez que les images sont bien uploadées et liées au projet.
                                </div>
                            @endif
                        </div>
                    </div>

                    @php
                        $images = $imageList;
                    @endphp

                    @if(count($images))
                        <div>
                            {{-- No need to show main image again --}}
                        </div>
                    @endif

                    <!-- Simple Full-Screen Gallery Overlay -->
                    <div id="imageOverlay" class="gallery-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.9); z-index: 9999; cursor: pointer;">
                        <div class="gallery-content" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); cursor: default;">
                            <img id="overlayImage" src="" class="img-fluid" style="max-width: 90vw; max-height: 90vh; object-fit: contain; border-radius: 8px;" alt="Project Image">
                            
                            <!-- Image counter -->
                            @if(count($images) > 1)
                            <div class="text-center mt-3">
                                <span id="overlayImageCounter" class="badge bg-light text-dark px-3 py-2 fs-6"></span>
                            </div>
                            @endif
                            
                            <!-- Navigation buttons -->
                            @if(count($images) > 1)
                            <button id="overlayPrevBtn" class="btn btn-outline-light position-absolute top-50 start-0 translate-middle-y ms-3" style="z-index: 10001;">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button id="overlayNextBtn" class="btn btn-outline-light position-absolute top-50 end-0 translate-middle-y me-3" style="z-index: 10001;">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const images = @json($images);
    let currentIndex = 0;

    function openImageModal(index) {
        currentIndex = index;
        updateOverlayImage();
        document.getElementById('imageOverlay').style.display = 'block';
    }

    function updateOverlayImage() {
        if (images.length > 0) {
            document.getElementById('overlayImage').src = images[currentIndex];
            updateOverlayImageCounter();
            updateOverlayNavigationButtons();
        }
    }

    function updateOverlayImageCounter() {
        const counter = document.getElementById('overlayImageCounter');
        if (counter && images.length > 1) {
            counter.textContent = `${currentIndex + 1} / ${images.length}`;
        }
    }

    function updateOverlayNavigationButtons() {
        const prevBtn = document.getElementById('overlayPrevBtn');
        const nextBtn = document.getElementById('overlayNextBtn');
        
        if (prevBtn) {
            prevBtn.style.display = currentIndex > 0 ? 'block' : 'none';
        }
        if (nextBtn) {
            nextBtn.style.display = currentIndex < images.length - 1 ? 'block' : 'none';
        }
    }

    function showPreviousImage() {
        if (currentIndex > 0) {
            currentIndex--;
            updateOverlayImage();
        }
    }

    function showNextImage() {
        if (currentIndex < images.length - 1) {
            currentIndex++;
            updateOverlayImage();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Navigation button event listeners
        const prevBtn = document.getElementById('overlayPrevBtn');
        const nextBtn = document.getElementById('overlayNextBtn');
        
        if (prevBtn) {
            prevBtn.addEventListener('click', showPreviousImage);
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', showNextImage);
        }

        // Close on overlay click
        document.getElementById('imageOverlay').addEventListener('click', function(event) {
            if (event.target === this) {
                this.style.display = 'none';
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            const overlay = document.getElementById('imageOverlay');
            if (overlay && overlay.style.display === 'block') {
                switch(e.key) {
                    case 'ArrowLeft':
                        showPreviousImage();
                        break;
                    case 'ArrowRight':
                        showNextImage();
                        break;
                    case 'Escape':
                        overlay.style.display = 'none';
                        break;
                }
            }
        });
    });
</script>
@endpush