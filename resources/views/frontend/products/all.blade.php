@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Products</h2>
    <form method="GET" class="mb-4 text-center">
        <select name="category_id" class="form-select d-inline-block w-auto" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @if(request('category_id') == $cat->id) selected @endif>{{ $cat->title }}</option>
            @endforeach
        </select>
    </form>
    @if(isset($category))
        <h4 class="mb-4 text-center">{{ $category->title }}</h4>
    @endif
    <div class="row g-4 justify-content-center">
        @forelse($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0 product-card">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/no-image.png') }}" class="card-img-top" alt="{{ $product->title }}" style="height:220px;object-fit:cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-0">{{ $product->title }}</h5>
                        <div class="text-muted small mt-1">{{ $product->category->title ?? '' }}</div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">No products found.</div>
        @endforelse
    </div>
</div>
<style>
.product-card:hover { box-shadow: 0 8px 32px rgba(0,0,0,0.12); transform: translateY(-4px) scale(1.03); transition: .2s; }
</style>
@endsection 