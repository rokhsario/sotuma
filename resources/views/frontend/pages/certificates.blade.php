@extends('frontend.layouts.master')

@section('title', 'Nos Certificats')

@section('main-content')
<style>
.certificate-hero {
    width: 100%;
    background: linear-gradient(120deg, #fff 0%, #f8f8f8 100%), url('https://www.transparenttextures.com/patterns/diamond-upholstery.png');
    border-radius: 28px;
    box-shadow: 0 6px 32px rgba(130,4,3,0.10);
    color: rgb(130,4,3);
    padding: 56px 32px 48px 32px;
    margin-bottom: 56px;
    display: flex;
    align-items: center;
    gap: 40px;
    justify-content: center;
    position: relative;
    overflow: hidden;
    min-height: 220px;
}
.certificate-hero-icon {
    font-size: 4.2rem;
    background: #fff;
    color: rgb(130,4,3);
    border-radius: 50%;
    padding: 28px 32px;
    box-shadow: 0 2px 16px rgba(130,4,3,0.10);
    margin-right: 32px;
    flex-shrink: 0;
    border: 2px solid #e53935;
}
.certificate-hero-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    max-width: 700px;
}
.certificate-hero-title {
    font-size: 2.7rem;
    font-weight: 900;
    letter-spacing: 1.5px;
    margin-bottom: 10px;
    color: rgb(130,4,3);
    text-shadow: 0 2px 12px rgba(130,4,3,0.08);
}
.certificate-hero-desc {
    font-size: 1.25rem;
    font-weight: 500;
    opacity: 0.97;
    color: #222;
    margin-bottom: 18px;
}
.certificate-hero-btn {
    background: #e53935;
    color: #fff;
    font-weight: 700;
    border-radius: 18px;
    padding: 12px 38px;
    font-size: 1.15rem;
    border: none;
    box-shadow: 0 2px 12px rgba(130,4,3,0.08);
    transition: background 0.2s, color 0.2s;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin-top: 8px;
}
.certificate-hero-btn:hover {
    background: #f7c948;
    color: #222;
}
.certificate-divider {
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #e53935 0%, rgb(130,4,3) 100%);
    border-radius: 2px;
    margin: 0 auto 48px auto;
    opacity: 0.18;
}
.certificate-section {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 32px rgba(130,4,3,0.08);
    margin-bottom: 48px;
    padding: 44px 38px;
    display: flex;
    align-items: center;
    gap: 48px;
    transition: box-shadow 0.2s;
    border-left: 8px solid #e53935;
}
.certificate-section:hover {
    box-shadow: 0 8px 48px rgba(130,4,3,0.18);
}
.certificate-img-viewer {
    flex: 0 0 420px;
    max-width: 420px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-radius: 18px;
    background: #f8f8f8;
    box-shadow: 0 2px 16px rgba(130,4,3,0.10);
    cursor: zoom-in;
    transition: box-shadow 0.2s;
    border: 2px solid #eee;
}
.certificate-img-viewer img {
    width: 100%;
    height: 320px;
    object-fit: contain;
    transition: box-shadow 0.2s;
}
.certificate-content {
    flex: 1 1 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-width: 220px;
}
.certificate-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: rgb(130,4,3);
    margin-bottom: 18px;
    letter-spacing: 2px;
    line-height: 1.4;
    word-break: break-word;
    white-space: pre-line;
}
.certificate-desc {
    font-size: 1.35rem;
    line-height: 2.1;
    color: #222;
    font-weight: 500;
    margin-bottom: 0;
}
.certificates-header {
    font-size: 2.3rem;
    font-weight: 900;
    color: rgb(130,4,3);
    letter-spacing: 2px;
    text-align: left;
    margin-bottom: 36px;
    margin-left: 8px;
    text-shadow: 0 2px 12px rgba(130,4,3,0.08);
}
.certificate-meta {
    font-size: 1rem;
    color: #888;
    margin-top: 12px;
    font-style: italic;
}
@media (max-width: 1100px) {
    .certificate-section { flex-direction: column; gap: 24px; padding: 24px 10px; border-left: 0; border-top: 8px solid #e53935; }
    .certificate-img-viewer { max-width: 100%; width: 100%; }
    .certificate-img-viewer img { height: 200px; }
    .certificate-title { font-size: 1.3rem; }
    .certificate-desc { font-size: 1.08rem; }
    .certificates-header { font-size: 1.5rem; }
    .certificate-hero { flex-direction: column; gap: 18px; padding: 24px 10px; text-align: center; min-height: 120px; }
    .certificate-hero-content { align-items: center; }
    .certificate-hero-title { font-size: 1.3rem; }
    .certificate-hero-desc { font-size: 1rem; }
    .certificate-hero-btn { font-size: 1rem; padding: 8px 18px; }
}
.certificate-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0; top: 0; width: 100vw; height: 100vh;
    background: rgba(30,30,30,0.92);
    align-items: center;
    justify-content: center;
    transition: opacity 0.2s;
    flex-direction: column;
}
.certificate-modal.active { display: flex; }
.certificate-modal-img {
    max-width: 90vw;
    max-height: 80vh;
    border-radius: 16px;
    box-shadow: 0 8px 48px rgba(130,4,3,0.18);
    background: #fff;
    padding: 12px;
    display: block;
    margin: 0 auto;
}
.certificate-modal-close {
    position: absolute;
    top: 32px;
    right: 48px;
    font-size: 2.5rem;
    color: #fff;
    cursor: pointer;
    z-index: 10001;
    transition: color 0.2s;
}
.certificate-modal-close:hover { color: #f7c948; }
</style>
<div class="container py-5">
    <div class="certificate-hero">
        <span class="certificate-hero-icon"><i class="fas fa-award"></i></span>
        <div class="certificate-hero-content">
            <div class="certificate-hero-title">Nos Certificats Officiels</div>
            <div class="certificate-hero-desc">Découvrez l’excellence, la fiabilité et la reconnaissance de nos certifications. Chaque distinction est la preuve de notre engagement envers la qualité, l’innovation et la confiance de nos partenaires.</div>
            <a href="#certificates-list" class="certificate-hero-btn">Voir les certificats</a>
        </div>
    </div>
    <div class="certificate-divider"></div>
    <h1 class="certificates-header" id="certificates-list">Liste des certificats</h1>
    @foreach($certificates as $certificate)
        <div class="certificate-section">
            <div class="certificate-img-viewer" title="Cliquez pour agrandir" onclick="showCertificateModal('{{ asset('storage/' . $certificate->image) }}')">
                <img src="{{ asset('storage/' . $certificate->image) }}" alt="{{ $certificate->title }}">
            </div>
            <div class="certificate-content">
                <div class="certificate-title">{{ $certificate->title }}</div>
                <div class="certificate-desc">{{ $certificate->description }}</div>
                <div class="certificate-meta">Certificat officiel SOTUMA</div>
            </div>
        </div>
    @endforeach
    @if($certificates->isEmpty())
        <div class="alert alert-info text-center">Aucun certificat pour le moment.</div>
    @endif
    <div class="d-flex justify-content-center mt-4">
        {{ $certificates->links() }}
    </div>
</div>
<!-- Modal for image inspect -->
<div class="certificate-modal" id="certificateModal" onclick="hideCertificateModal(event)">
    <span class="certificate-modal-close" onclick="hideCertificateModal(event)" title="Fermer">&times;</span>
    <img src="" alt="Certificat" class="certificate-modal-img" id="certificateModalImg" onclick="event.stopPropagation()">
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script>
function showCertificateModal(imgUrl) {
    var modal = document.getElementById('certificateModal');
    var modalImg = document.getElementById('certificateModalImg');
    modalImg.src = imgUrl;
    modal.classList.add('active');
}
function hideCertificateModal(e) {
    // Only close if clicking the modal background or close button, not the image
    if (e.target.classList.contains('certificate-modal') || e.target.classList.contains('certificate-modal-close')) {
        document.getElementById('certificateModal').classList.remove('active');
        document.getElementById('certificateModalImg').src = '';
    }
}
</script>
@endsection 