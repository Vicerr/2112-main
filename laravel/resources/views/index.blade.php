<x-layout :cart="$cart">
  @push('title')| Home @endpush
<div class="container">
    <div class="hero--section ">
      <p class="hero--title">Discover and Elevate Your own <span>Style</span></p>
      <p class="hero--description text-secondary">Where creativity meets coutute. Explore our exclusive designs, crafted with passion and precision to bring your fashion dreams to life.</p>

      <a href="{{ route('products') }}" class="cta">Shop now</a>
    </div>
  </div>
  <div class="swiper-section" id="swiper">
    <div class="swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="{{ asset('images/img-8362-66808618358dc.webp') }}" loading="lazy" alt="" loading="lazy">

        </div>
        <div class="swiper-slide">
          <img src="{{ asset('images/img-8363-668086187b09e.webp') }}" loading="lazy" alt="" loading="lazy">

        </div>
        <div class="swiper-slide">
          <img src="{{ asset('images/img-8357-6680862f9939b.webp') }}" loading="lazy" alt="" loading="lazy">

        </div>
        <div class="swiper-slide">
          <img src="{{ asset('images/img-8358-66808634741f3.webp') }}" loading="lazy" alt="" loading="lazy">

        </div>
        <div class="swiper-slide">
          <img src="{{ asset('images/photo-2024-06-24-17-10-22-6680863dceabe.webp') }}" loading="lazy" alt="" loading="lazy">

        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>

  <section class="product--section container">
    <div class="product--header">
      <h2 class="product--section--heading">Discover new colections</h2>
      <p class="product--section-description text-secondary">Discover the latest trends and timeless classics at 2112</p>
    </div>
    <div class="product--container">
      <!-- product item  -->
      <a href="./product.html" class="product--item">
        <div class="product--image-container">
          <!-- product image  -->
          <img src="{{ asset('images/img-8337-6680861cdabff.webp') }}" loading="lazy" alt="">
        </div>
        <div class="product--item--description">
          <!-- product name -->
          <p class="product--item--name">Shirt</p>
          <!-- product price -->
          <p class="product--item--price">$400</p>
        </div>
      </a>

      <a href="./product.html" class="product--item">
        <div class="product--image-container">
          <img src="{{ asset('images/img-8336-6680861d35809.webp') }}" loading="lazy" alt="">
        </div>
        <div class="product--item--description">
          <p class="product--item--name">Shirt</p>
          <p class="product--item--price">$400</p>
        </div>
      </a>


      <a href="./product.html" class="product--item">
        <div class="product--image-container">
          <img src="{{ asset('images/img-8338-668086222d99d.webp') }}" loading="lazy" alt="">
        </div>
        <div class="product--item--description">
          <p class="product--item--name">Shirt</p>
          <p class="product--item--price">$400</p>
        </div>
      </a>

      <a href="./product.html" class="product--item">
        <div class="product--image-container">
          <img src="{{ asset('images/img-8339-6680862dce627.webp') }}" loading="lazy" alt="">
        </div>
        <div class="product--item--description">
          <p class="product--item--name">Shirt</p>
          <p class="product--item--price">$400</p>
        </div>
      </a>


    </div>
    <div class="cta-container">
      <a href="{{ route('products') }}" class="cta">Shop now</a>
    </div>
  </section>
  <section class="review full-width">
    <h2>What people say about us</h2>
    <div class="wrapper">
      <div class="review--card">
        <div class="card--rating">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
        </div>

        <div class="review--content">
          <p>
            Great quality, true-to-size clothing with good shipping time. Loved the styles and I'll definitely order again.
          </p>
        </div>
        <div class="review--profile">
          <div class="review--img"><img src="{{ asset('images/img-8336-6680861d35809.webp') }}" alt=""></div>
          <div class="review--details">
            <p class="review--name">Azeem Olaniyan
            </p>
            <p class="review--email">azeemola@gmil.com</p>
          </div>
        </div>
      </div>
      <div class="review--card">
        <div class="card--rating">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
        </div>
        <div class="review--content">
          <p>
            Beautiful shirts, luxurious fabric. Runs slightly small, but easy exchange process. Will shop here again.
          </p>
        </div>
        <div class="review--profile">
          <div class="review--img"></div>
          <div class="review--details">
            <p class="review--name">Victor Odoi
            </p>
            <p class="review--email">simply.victor3@gmail.com</p>
          </div>
        </div>
      </div>
      <div class="review--card">
        <div class="card--rating">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
          <img src="{{ asset('images/icons/star.svg') }}" alt="star">
          <img src="{{ asset('images/icons/nostar.svg') }}" alt="star">
        </div>

        <div class="review--content">
          <p>
            Great quality shirt and jeans, perfect fit, and fast delivery. Stylish and durable. Higly Recommended.
          </p>
        </div>
        <div class="review--profile">
          <div class="review--img"></div>
          <div class="review--details">
            <p class="review--name">Amy Goldverg
            </p>
            <p class="review--email">amygoldberg@gmail.com</p>
          </div>
        </div>
      </div>


    </div>
  </section>
  <section class="product--section container">
    <div class="product--header">
      <h2 class="product--section--heading">Top Sellers</h2>
      <p class="product--section-description text-secondary">Browse our top selling products</p>
    </div>
    <div class="product--container">
      <a href="./product.html" class="product--item">
        <div class="product--image-container">
          <img src="{{ asset('images/img-8337-6680861cdabff.webp') }}" loading="lazy" alt="">
        </div>
        <div class="product--item--description">
          <p class="product--item--name">Shirt</p>
          <p class="product--item--price">$400</p>
        </div>
      </a>

      <a href="./product.html" class="product--item">
        <div class="product--image-container">
          <img src="{{ asset('images/img-8336-6680861d35809.webp') }}" loading="lazy" alt="">
        </div>
        <div class="product--item--description">
          <p class="product--item--name">Shirt</p>
          <p class="product--item--price">$400</p>
        </div>
      </a>


      <a href="./product.html" class="product--item">
        <div class="product--image-container">
          <img src="{{ asset('images/img-8338-668086222d99d.webp') }}" loading="lazy" alt="">
        </div>
        <div class="product--item--description">
          <p class="product--item--name">Shirt</p>
          <p class="product--item--price">$400</p>
        </div>
      </a>

      <a href="./product.html" class="product--item">
        <div class="product--image-container">
          <img src="{{ asset('images/img-8339-6680862dce627.webp') }}" loading="lazy" alt="">
        </div>
        <div class="product--item--description">
          <p class="product--item--name">Shirt</p>
          <p class="product--item--price">$400</p>
        </div>
      </a>


    </div>
    <div class="cta-container">
      <a href="{{ route('products') }}" class="cta">Shop now</a>
    </div>
  </section>
</x-layout>