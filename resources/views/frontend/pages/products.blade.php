@extends('frontend.layouts.master')
@section('title', 'Nos Produits')
@section('main-content')
<style>
.catalogue-container {
    width: 100vw;
    max-width: 100vw;
    margin: 0;
    padding: 0;
    background: #fafbfc;
}
.catalogue-section {
    width: 100vw;
    max-width: 100vw;
    margin: 0;
    padding: 0 0 48px 0;
    position: relative;
}
.catalogue-category-bar {
    width: 100vw;
    max-width: 100vw;
    background: rgb(130,4,3);
    color: #fff;
    font-size: 2.1rem;
    font-weight: 900;
    letter-spacing: 1.5px;
    padding: 28px 0 18px 32px;
    margin: 0;
    border-top: 1px solid #eee;
    border-bottom: 2px solid #f7c948;
    box-shadow: 0 2px 12px rgba(130,4,3,0.04);
    position: sticky;
    top: 0;
    z-index: 10;
}
.catalogue-row-wrapper {
    position: relative;
    width: 100vw;
    max-width: 100vw;
    overflow: hidden;
}
.catalogue-row {
    display: flex;
    gap: 36px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 36px 0 16px 32px;
    margin: 0;
    scrollbar-width: thin;
    scroll-snap-type: x mandatory;
}
.catalogue-card {
    flex: 0 0 200px;
    max-width: 200px;
    min-width: 200px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(130,4,3,0.10);
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 18px 12px 18px 12px;
    transition: box-shadow 0.2s, transform 0.18s;
    cursor: pointer;
    scroll-snap-align: start;
    margin-bottom: 0;
}
.catalogue-card:hover {
    box-shadow: 0 8px 32px rgba(130,4,3,0.16);
    transform: translateY(-4px) scale(1.03);
}
.catalogue-product-name {
    font-size: 1.08rem;
    font-weight: 700;
    color: rgb(130,4,3);
    margin-bottom: 12px;
    text-align: center;
    word-break: break-word;
}
.catalogue-img {
    width: 160px;
    height: 160px;
    object-fit: cover;
    border-radius: 12px;
    background: #f3f3f3;
    box-shadow: 0 2px 8px rgba(130,4,3,0.07);
}
.catalogue-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 20;
    background: rgba(130,4,3,0.85);
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    cursor: pointer;
    box-shadow: 0 2px 12px rgba(130,4,3,0.13);
    opacity: 0.85;
    transition: background 0.2s, opacity 0.2s;
}
.catalogue-arrow:hover {
    background: #f7c948;
    color: rgb(130,4,3);
    opacity: 1;
}
.catalogue-arrow.left { left: 8px; }
.catalogue-arrow.right { right: 8px; }
@media (max-width: 900px) {
    .catalogue-category-bar { font-size: 1.3rem; padding: 18px 0 10px 12px; }
    .catalogue-row { gap: 18px; padding: 18px 0 10px 12px; }
    .catalogue-card { min-width: 140px; max-width: 140px; }
    .catalogue-img { width: 100px; height: 100px; }
    .catalogue-arrow { width: 36px; height: 36px; font-size: 1.3rem; }
}
.product-modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    width: 100vw; height: 100vh;
    background: rgba(30,30,30,0.65);
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
}
.product-modal-content {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 8px 48px rgba(130,4,3,0.18);
    padding: 36px 28px 28px 28px;
    max-width: 420px;
    width: 92vw;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    animation: modalIn 0.18s cubic-bezier(.4,1.4,.6,1) 1;
}
@keyframes modalIn {
    from { transform: scale(0.92) translateY(40px); opacity: 0; }
    to { transform: scale(1) translateY(0); opacity: 1; }
}
.product-modal-close {
    position: absolute;
    top: 16px; right: 16px;
    background: none;
    border: none;
    color: rgb(130,4,3);
    font-size: 1.7rem;
    cursor: pointer;
    z-index: 2;
    transition: color 0.2s;
}
.product-modal-close:hover { color: #f7c948; }
.product-modal-img {
    width: 220px; height: 220px;
    object-fit: cover;
    border-radius: 12px;
    background: #f3f3f3;
    margin-bottom: 18px;
    box-shadow: 0 2px 8px rgba(130,4,3,0.07);
}
.product-modal-title {
    font-size: 1.25rem;
    font-weight: 800;
    color: rgb(130,4,3);
    margin-bottom: 12px;
    text-align: center;
}
.product-modal-desc {
    font-size: 1.07rem;
    color: #444;
    text-align: center;
    margin-bottom: 0;
    max-height: 260px;
    overflow-y: auto;
}
@media (max-width: 600px) {
    .product-modal-content { padding: 18px 6px 18px 6px; }
    .product-modal-img { width: 120px; height: 120px; }
}
</style>
<div class="catalogue-container">
    @foreach($categories as $category)
        @if($category->products->count())
        <section class="catalogue-section">
            <div class="catalogue-category-bar">{{ $category->title }}</div>
            <div class="catalogue-row-wrapper">
                <button class="catalogue-arrow left" onclick="scrollCatalogueRow(this, -1)"><i class="fas fa-chevron-left"></i></button>
                <div class="catalogue-row">
                    @foreach($category->products as $product)
                        <div class="catalogue-card" onclick="openProductModal({{ $product->id }}, '{{ addslashes($product->title) }}', '{{ asset($product->photo) }}', `{!! addslashes($product->description) !!}`)">
                            <div class="catalogue-product-name">{{ $product->title }}</div>
                            <img src="{{ asset($product->photo) }}" alt="{{ $product->title }}" class="catalogue-img" />
                        </div>
                    @endforeach
                </div>
                <button class="catalogue-arrow right" onclick="scrollCatalogueRow(this, 1)"><i class="fas fa-chevron-right"></i></button>
            </div>
        </section>
        @endif
    @endforeach
    <!-- Product Modal -->
    <div id="product-modal" class="product-modal-overlay" style="display:none;">
        <div class="product-modal-content">
            <button class="product-modal-close" onclick="closeProductModal()"><i class="fas fa-times"></i></button>
            <img id="modal-img" src="" alt="" class="product-modal-img" />
            <div class="product-modal-title" id="modal-title"></div>
            <div class="product-modal-desc" id="modal-desc"></div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script>
function scrollCatalogueRow(btn, dir) {
    const wrapper = btn.closest('.catalogue-row-wrapper');
    const row = wrapper.querySelector('.catalogue-row');
    const card = row.querySelector('.catalogue-card');
    if (!card) return;
    const scrollAmount = card.offsetWidth * 2 + 36 * 2; // 2 cards + gap
    row.scrollBy({ left: dir * scrollAmount, behavior: 'smooth' });
}
function openProductModal(id, title, img, desc) {
    document.getElementById('modal-img').src = img;
    document.getElementById('modal-title').textContent = title;
    document.getElementById('modal-desc').innerHTML = desc;
    document.getElementById('product-modal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeProductModal() {
    document.getElementById('product-modal').style.display = 'none';
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeProductModal();
});
document.getElementById('product-modal').addEventListener('click', function(e) {
    if (e.target === this) closeProductModal();
});
</script>
@endsection 