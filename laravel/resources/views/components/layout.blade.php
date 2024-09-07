<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>21/12 @stack('title')</title>
  <meta name="description" content="21/12 is a clothing company where customers can order or pickup already made clothe or make a custom order of clothe for yourself.">
  <meta name="keywords" content="clothing, twenty one twelve, 2112,21/12, online clothing store, store">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <div class="logo-container"><a href="{{ route("home") }}"><img src="{{asset('images/logo.png')}}" alt=""></a></div>
        <div class="nav-misc" data-navigation-status="closed" id="nav-misc">
          <button id="close-navigation" onclick="toggleNav()">
            <div class="cross"></div>
          </button>
          <ul class="nav-items pointer">
            <li><a class="nav-link" href="{{ route('home') }}">Home</a></li>
            <li><a class="nav-link" href="{{ route('products') }}">Collections</a></li>
            <li><a class="nav-link hide" href="{{ route('checkout') }}">Orders</a></li>
            <li><a class="nav-link hide" href="{{ route('cart') }}">Cart</a></li>
            <li><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
            @if (auth()->check())
              @if (auth()->user()->role != 'user')
              <li><a class="nav-link" href="{{ route('dashboard') }}">Admin</a></li>
              @endif
            @endif
            @if (auth()->check())
              <form class="link-item" method="POST" action="{{ route('logout') }}">
                @csrf
                <a role="button" type="submit" class="nav-link">
                <button style="all:unset; color: #024e82; font-weight: 600;"> Logout </button>
                </a>
              </form>
            @else
                <li><a class="nav-link" href="{{ route('register') }}"> Sign up </a></li>
                <li><a class="nav-link" href="{{ route('login') }}"> Login</a></li>
            @endif
          </ul>
          <div class="actions">
            <a href="{{ route('cart') }}" class="icon"><img src="{{ asset('images/icons/save.svg') }}" alt=""></a>
            <a href="{{ route('dashboard') }}" class="icon" data-counter="10"><img src="{{ asset('images/icons/envelope.svg') }}" alt=""></a href="">
          </div>
        </div>
        <button id="open-navigation" onclick="toggleNav()">
          <div class="bar"></div>
        </button>

      </div>

    </div>
  </nav>
  <x-flash-message />
  <x-error-message />
  <main>
    {{$slot}}
  </main>

  <footer class="full-width">
    <div class="footer-wrapper">
      <div class="logo"><img src="{{asset('images/logo.png')}}" alt=""></div>
      <ul class="quick-links">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="">Brands</a></li>
        <li><a href="{{ route('products') }}">Collection</a></li>
        <li><a href="{{ route('contact') }}">About Us</a></li>
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
  <!-- EXTERNAL JAVASCRIPT -->
  <script language="JavaScript" type="text/javascript" src="http://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  <script language="JavaScript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
  
  <!-- JAVASCRIPT FILES -->
  <script language="JavaScript" type="text/javascript" src="{{asset('js/main.js')}}"></script>
  @stack('script')
</body>

</html>