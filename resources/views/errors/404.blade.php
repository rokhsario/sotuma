<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Google Tag Manager -->
  @if(config('services.google_tag_manager_id'))
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer',@json(config('services.google_tag_manager_id')));</script>
  @endif
  <!-- End Google Tag Manager -->
  
  <!-- Google Analytics (GA4) -->
  @if(config('services.google_analytics_id'))
  <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics_id') }}"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{{ config('services.google_analytics_id') }}');
  </script>
  @endif
  <!-- End Google Analytics -->

  @include('backend.layouts.head')

<body>
  
  <div class="container-fluid">

    <div class="row" style="margin-top:10%">
        <!-- 404 Error Text -->
      <div class="col-md-12">
        <div class="text-center">
          <div class="error mx-auto" data-text="404">404</div>
          <p class="lead text-gray-800 mb-5">Page Not Found</p>
          <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
          {{-- {{dd(auth()->user())}}; --}}
            <a href="{{route('home')}}">&larr; Back to Home</a>

        </div>
      </div>
    </div>

    </div>


    @include('backend.layouts.footer')

</body>

</html>
