<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'MarketLink – eGreen Basket | Modern Luxury Organic Marketplace')</title>
  <meta name="description" content="@yield('meta_description', 'Discover fresh seasonal produce, explore local farmers markets, and reserve your favorites for convenient pickup with MarketLink.')">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🌿</text></svg>">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
  @yield('styles')
</head>
<body>

  @include('partials.navbar')

  <main>
    @yield('content')
  </main>

  @include('partials.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/cart.js') }}"></script>
  <script src="{{ asset('assets/js/ai-assistant.js') }}"></script>
  @yield('scripts')
</body>
</html>
