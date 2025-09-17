@extends('frontend.layouts.master')
@section('title','Nos {{ __('frontend.products') }}')
@section('main-content')
<script>window.location.href = '{{ route('products.nos') }}';</script>
<noscript>
    <div style="width:100vw;max-width:100vw;text-align:center;padding:80px 0;font-size:1.5rem;">
        Veuillez visiter <a href="{{ route('products.nos') }}">la nouvelle page Nos {{ __('frontend.products') }}</a>.
    </div>
</noscript>
@endsection
