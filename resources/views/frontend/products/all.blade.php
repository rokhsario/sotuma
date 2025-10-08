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
                        @php
                            $hasManual = (!is_null($product->title_line1) || !is_null($product->title_line2) || !is_null($product->title_line3));
                            if ($hasManual) {
                                $line1 = $product->title_line1 ?? '';
                                $line2 = $product->title_line2 ?? '';
                                $line3 = $product->title_line3 ?? '';
                                $break = $break2 = null;
                            } else {
                                $words = preg_split('/\s+/', trim($product->title));
                                $break = is_numeric($product->title_break_index) ? (int) $product->title_break_index : null;
                                $break2 = is_numeric($product->title_break_index_2) ? (int) $product->title_break_index_2 : null;
                                $line1 = '';$line2 = '';$line3 = '';
                                if ($break !== null && $break > 0 && $break < count($words)) {
                                    if ($break2 !== null && $break2 > $break && $break2 < count($words)) {
                                        $line1 = implode(' ', array_slice($words, 0, $break));
                                        $line2 = implode(' ', array_slice($words, $break, $break2 - $break));
                                        $line3 = implode(' ', array_slice($words, $break2));
                                    } else {
                                        $line1 = implode(' ', array_slice($words, 0, $break));
                                        $remaining = array_slice($words, $break);
                                        $half2 = (int) ceil(count($remaining) / 2);
                                        $line2 = implode(' ', array_slice($remaining, 0, $half2));
                                        $line3 = implode(' ', array_slice($remaining, $half2));
                                    }
                                } else {
                                    $n = count($words);
                                    $third1 = (int) ceil($n / 3);
                                    $third2 = (int) ceil(($n - $third1) / 2);
                                    $line1 = implode(' ', array_slice($words, 0, $third1));
                                    $line2 = implode(' ', array_slice($words, $third1, $third2));
                                    $line3 = implode(' ', array_slice($words, $third1 + $third2));
                                }
                            }
                        @endphp
                        @php $singleLine = (!$hasManual && $break === null && $break2 === null && mb_strlen($product->title) <= 22); @endphp
                        <h5 class="card-title mb-0" style="line-height:1.25; max-width:98%; margin-left:auto; margin-right:auto; white-space: normal;">
                            @if($singleLine)
                                {{ $product->title }}
                            @else
                                {!! $line1 !== '' ? '<span>'.e($line1).'</span>' : '' !!}
                                {!! $line2 !== '' ? '<br><span>'.e($line2).'</span>' : '' !!}
                                {!! $line3 !== '' ? '<br><span>'.e($line3).'</span>' : '' !!}
                            @endif
                        </h5>
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