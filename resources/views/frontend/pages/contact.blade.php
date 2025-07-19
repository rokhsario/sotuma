@extends('frontend.layouts.master')

@section('title', 'Contactez-nous')

@section('main-content')
<style>
/* --- Modern Contact Page Styles --- */
:root {
    --sotuma-red: rgb(130,4,3);
    --sotuma-gold: #f7c948;
    --glass-bg: rgba(255,255,255,0.65);
    --glass-blur: blur(8px);
    --card-shadow: 0 8px 32px rgba(130,4,3,0.13);
    --border-radius: 22px;
}
.contact-hero {
    background: linear-gradient(120deg, #fff 0%, #f8f8f8 100%);
    border-radius: var(--border-radius);
    box-shadow: 0 6px 32px rgba(130,4,3,0.10);
    color: var(--sotuma-red);
    padding: 64px 32px 48px 32px;
    margin-bottom: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
    overflow: hidden;
    z-index: 2;
}
.contact-hero::before {
    content: '';
    position: absolute;
    top: -60px; left: -80px;
    width: 320px; height: 320px;
    background: radial-gradient(circle at 60% 40%, var(--sotuma-red) 0%, transparent 70%);
    opacity: 0.08;
    z-index: 1;
}
.contact-hero-title {
    font-size: 3.2rem;
    font-weight: 900;
    letter-spacing: 2px;
    margin-bottom: 12px;
    color: var(--sotuma-red);
    text-shadow: 0 2px 12px rgba(130,4,3,0.08);
    position: relative;
    z-index: 2;
}
.contact-hero-title::after {
    content: '';
    display: block;
    margin: 18px auto 0 auto;
    width: 80px;
    height: 4px;
    border-radius: 2px;
    background: linear-gradient(90deg, var(--sotuma-gold), var(--sotuma-red));
    opacity: 0.7;
}
.contact-hero-desc {
    font-size: 1.22rem;
    font-weight: 500;
    opacity: 0.97;
    color: #222;
    margin-bottom: 0;
    z-index: 2;
}

/* Restore: Card style, horizontal line */
.contact-info-cards {
    display: flex;
    gap: 36px;
    justify-content: center;
    align-items: stretch;
    margin-top: 56px;
    margin-bottom: 56px;
    flex-wrap: nowrap;
    position: relative;
    z-index: 3;
    overflow-x: auto;
    padding-bottom: 8px;
    scrollbar-width: thin;
}
.contact-info-card {
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    padding: 28px 20px 24px 20px;
    min-width: 180px;
    max-width: 220px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    font-size: 1.05rem;
    color: #222;
    border: 1.5px solid rgba(130,4,3,0.07);
    transition: box-shadow 0.25s, transform 0.18s;
    position: relative;
    flex: 0 0 auto;
}
.contact-info-card:hover {
    box-shadow: 0 12px 40px rgba(130,4,3,0.18);
    transform: translateY(-6px) scale(1.03);
}
.contact-info-icon {
    font-size: 2.5rem;
    background: linear-gradient(135deg, var(--sotuma-gold) 60%, var(--sotuma-red) 100%);
    color: #fff;
    border-radius: 50%;
    width: 56px; height: 56px;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 8px;
    box-shadow: 0 2px 12px rgba(130,4,3,0.10);
    transition: box-shadow 0.2s, background 0.2s;
}
.contact-info-card:hover .contact-info-icon {
    box-shadow: 0 4px 18px var(--sotuma-gold);
    background: linear-gradient(135deg, var(--sotuma-red) 60%, var(--sotuma-gold) 100%);
}
.contact-info-card a {
    color: var(--sotuma-red);
    text-decoration: underline;
    font-weight: 600;
}
.contact-info-card a:hover {
    color: var(--sotuma-gold);
}
.contact-form-section {
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    padding: 48px 38px 38px 38px;
    margin-bottom: 56px;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    z-index: 2;
}
.contact-form-title {
    font-size: 1.7rem;
    font-weight: 800;
    color: var(--sotuma-red);
    margin-bottom: 22px;
    text-align: center;
}
.contact-form {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}
.contact-form-group {
    position: relative;
    margin-bottom: 24px;
}
.contact-form input, .contact-form textarea {
    width: 100%;
    border-radius: 12px;
    border: 1.5px solid #e0e0e0;
    padding: 18px 16px 18px 16px;
    font-size: 1.08rem;
    background: #fafafa;
    transition: border 0.2s, box-shadow 0.2s;
    outline: none;
}
.contact-form input:focus, .contact-form textarea:focus {
    border: 1.5px solid var(--sotuma-red);
    box-shadow: 0 2px 12px rgba(130,4,3,0.08);
}
.contact-form label {
    position: absolute;
    left: 18px;
    top: 18px;
    color: #888;
    font-weight: 600;
    font-size: 1.02rem;
    pointer-events: none;
    background: transparent;
    transition: 0.2s;
}
.contact-form input:focus + label,
.contact-form input:not(:placeholder-shown) + label,
.contact-form textarea:focus + label,
.contact-form textarea:not(:placeholder-shown) + label {
    top: -12px;
    left: 10px;
    background: var(--glass-bg);
    padding: 0 6px;
    color: var(--sotuma-red);
    font-size: 0.98rem;
}
.contact-form textarea {
    min-height: 120px;
    resize: vertical;
}
.contact-form .file-upload-area {
    border: 2px dashed #e0e0e0;
    border-radius: 12px;
    background: #fafafa;
    padding: 28px 0;
    text-align: center;
    margin-bottom: 24px;
    transition: border 0.2s, background 0.2s;
    cursor: pointer;
    position: relative;
}
.contact-form .file-upload-area.dragover {
    border-color: var(--sotuma-red);
    background: #fff3f3;
}
.contact-form .file-upload-area i {
    font-size: 2.2rem;
    color: var(--sotuma-red);
    margin-bottom: 8px;
}
.contact-form .file-upload-area span {
    display: block;
    color: #888;
    font-size: 1.05rem;
}
.contact-form button {
    background: linear-gradient(90deg, var(--sotuma-red), var(--sotuma-gold));
    color: #fff;
    font-weight: 800;
    border-radius: 22px;
    padding: 14px 44px;
    font-size: 1.18rem;
    border: none;
    box-shadow: 0 2px 12px rgba(130,4,3,0.08);
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    letter-spacing: 1px;
}
.contact-form button:hover {
    background: linear-gradient(90deg, var(--sotuma-gold), var(--sotuma-red));
    color: #222;
    box-shadow: 0 4px 18px var(--sotuma-gold);
}
.contact-map-section {
    border-radius: var(--border-radius);
    overflow: hidden;
    box-shadow: 0 2px 16px rgba(130,4,3,0.10);
    margin-bottom: 24px;
    position: relative;
    z-index: 1;
}
.contact-map-pin {
    position: absolute;
    top: 18px;
    left: 18px;
    z-index: 10;
    background: var(--sotuma-red);
    color: #fff;
    border-radius: 50%;
    width: 48px; height: 48px;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 2px 12px rgba(130,4,3,0.13);
    font-size: 2rem;
    border: 3px solid #fff;
}
@media (max-width: 900px) {
    /* Remove the rule that stacks cards vertically */
    .contact-form-section { padding: 18px 6px; }
    .contact-map-section { margin: 0 -8px 24px -8px; }
    .contact-hero { padding: 38px 8px 28px 8px; }
    .contact-hero-title { font-size: 2.1rem; }
}
</style>
<div class="container py-5">
    <div class="contact-hero">
        <div class="contact-hero-title">Contactez SOTUMA</div>
        <div class="contact-hero-desc">Un projet, une question ? Notre équipe vous accompagne avec passion et expertise.</div>
    </div>
    <div class="contact-info-cards">
        <div class="contact-info-card">
            <span class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></span>
            <div><strong>Adresse</strong></div>
            <div>{{ $settings->address }}</div>
        </div>
        <div class="contact-info-card">
            <span class="contact-info-icon"><i class="fas fa-phone"></i></span>
            <div><strong>Téléphone</strong></div>
            <div>{{ $settings->phone }}</div>
        </div>
        <div class="contact-info-card">
            <span class="contact-info-icon"><i class="fas fa-envelope"></i></span>
            <div><strong>Email</strong></div>
            <div><a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a></div>
        </div>
        <div class="contact-info-card">
            <span class="contact-info-icon"><i class="fab fa-facebook-f"></i></span>
            <div><strong>Facebook</strong></div>
            <div><a href="{{ $settings->facebook }}" target="_blank">SOTUMA</a></div>
        </div>
    </div>
    <div class="contact-form-section">
        <div class="contact-form-title">Envoyez-nous un message</div>
        <form class="contact-form" method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="contact-form-group">
                <input type="text" name="name" id="name" required placeholder=" " autocomplete="off">
                <label for="name">Nom</label>
            </div>
            <div class="contact-form-group">
                <input type="email" name="email" id="email" required placeholder=" " autocomplete="off">
                <label for="email">Email</label>
            </div>
            <div class="contact-form-group">
                <input type="text" name="subject" id="subject" required placeholder=" " autocomplete="off">
                <label for="subject">Sujet</label>
            </div>
            <div class="contact-form-group">
                <textarea name="message" id="message" required placeholder=" "></textarea>
                <label for="message">Message</label>
            </div>
            <div class="contact-form-group">
                <div class="file-upload-area" id="file-upload-area">
                    <i class="fas fa-paperclip"></i>
                    <span id="file-upload-text">Fichier PDF ou pièce jointe (glissez-déposez ou cliquez ici)</span>
                    <input type="file" name="attachment" id="attachment" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" style="opacity:0;position:absolute;left:0;top:0;width:100%;height:100%;cursor:pointer;">
                </div>
            </div>
            <button type="submit">Envoyer</button>
        </form>
    </div>
    <div class="contact-map-section" style="position:relative;">
        <div class="contact-map-pin"><i class="fas fa-map-marker-alt"></i></div>
        <iframe src="https://www.google.com/maps?q=34.740837,10.760556&hl=fr&z=16&output=embed" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script>
// File upload drag & drop effect
const fileUploadArea = document.getElementById('file-upload-area');
const fileInput = document.getElementById('attachment');
const fileText = document.getElementById('file-upload-text');
if(fileUploadArea && fileInput && fileText) {
    fileUploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        fileUploadArea.classList.add('dragover');
    });
    fileUploadArea.addEventListener('dragleave', function(e) {
        fileUploadArea.classList.remove('dragover');
    });
    fileUploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        fileUploadArea.classList.remove('dragover');
        if(e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            fileText.textContent = e.dataTransfer.files[0].name;
        }
    });
    fileInput.addEventListener('change', function(e) {
        if(fileInput.files.length) {
            fileText.textContent = fileInput.files[0].name;
        } else {
            fileText.textContent = 'Fichier PDF ou pièce jointe (glissez-déposez ou cliquez ici)';
        }
    });
}
</script>
@endsection