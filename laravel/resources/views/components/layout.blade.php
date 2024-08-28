<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>2112 @stack('title')</title>
  <meta name="description" content="21/12 is a clothing company where customers can order or pickup already made clothe or make a custom order of clothe for yourself.">
  <meta name="keywords" content="clothing, twenty one twelve, 2112,21/12, online clothing store, store">
  <link rel="stylesheet" href="{{asset('css/main.css')}}">
  <link rel="stylesheet" href="{{asset('css/swiper-bundle.min.css')}}">
  @stack('style')
  <script defer type="module" src="{{asset('js/swiper-config.js')}}"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Frank+Ruhl+Libre&display=swap" rel="stylesheet">
  <script defer src="{{asset('js/main.js')}}"></script>
</head>

<body>
  <nav class="navigation">
    <div class="wrapper container">
      <div class="breakout">
        <div class="logo-container"><img src="{{asset('images/logo.png')}}" alt=""></div>
        <div class="nav-misc" data-navigation-status="closed" id="nav-misc">
          <button id="close-navigation" onclick="toggleNav()">
            <div class="cross"></div>
          </button>
          <ul class="nav-items">
            <li><a class="nav-link" href="{{ route('home') }}">Home</a></li>

            <li><a class="nav-link" href="/products.html">Collections</a></li>
            <li><a class="nav-link hide" href="/checkout.html">Orders</a></li>
            <li><a class="nav-link hide" href="/cart.html">Cart</a></li>
            <li><a class="nav-link" href="/contact.html">Contact</a></li>
          </ul>
          <div class="actions">
            <a href="./cart.html" class="icon"><img src="{{ asset('images/icons/save.svg') }}" alt=""></a>
            <a href="./dashboard.html" class="icon" data-counter="10"><img src="{{ asset('images/icons/envelope.svg') }}" alt=""></a href="">
          </div>
        </div>
        <button id="open-navigation" onclick="toggleNav()">
          <div class="bar"></div>
        </button>

      </div>

    </div>
  </nav>
  <main>
    {{$slot}}
  </main>

  <footer class="full-width">
    <div class="footer-wrapper">
      <div class="logo"><img src="{{asset('images/logo.png')}}" alt=""></div>
      <ul class="quick-links">
        <li><a href="">Home</a></li>
        <li><a href="">Brands</a></li>
        <li><a href="">Collection</a></li>
        <li><a href="">About Us</a></li>
      </ul>
      <ul class="quick-links">
        <li>Contact Us</li>
        <li><a href="tel:">4949494949</a></li>
        <li><a href="mailto:">something@gmail.com</a></li>
        <li><a href="https://">website.com</a></li>
      </ul>
      <div class="socials">
        <p>All Rights Reserved 2024</p>
        <ul>
          <li class="icons"><a href=""><img src="{{asset('images/icons/tiktok.svg')}}" loading="lazy" alt=""></a></li>
          <li class="icons"><a href=""><img src="{{asset('images/icons/instagram.svg')}}" loading="lazy" alt=""></a></li>
          <li class="icons"><a href=""><img src="{{asset('images/icons/twitter.svg')}}" loading="lazy" alt=""></a></li>
        </ul>
      </div>
    </div>
  </footer>
  <div class="quick-cta">
    <img src="{{asset('images/icons/whatsapp.svg')}}" alt="">
    <a href=""></a>
  </div>
</body>

</html>