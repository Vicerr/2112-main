<x-layout :cart="$cart">
  @push('title')| {{ $product->name }} @endpush
  <main class="container">
    <section class="item--container">
      <div class="item--product-details">
        <div class="item--image-container">
          <!-- product images -->
          @if (!empty($product->images[0]->path))
            <img class="wide" src="{{  asset($product->images[0]->path) }}" alt="">
          @else
            <img src="{{ asset('images/logo.png') }}" alt="">
          @endif
          @if (!empty($product->images[1]->path))
            <img src="{{  asset($product->images[1]->path) }}" alt="">
          @else
            <img src="{{ asset('images/logo.png') }}" alt="">
          @endif
          @if (!empty($product->images[2]->path))
            <img src="{{  asset($product->images[2]->path) }}" alt="">
          @else
            <img src="{{ asset('images/logo.png') }}" alt="">
          @endif
          @if (!empty($product->images[3]->path))
            <img src="{{  asset($product->images[3]->path) }}" alt="">
          @else
            <img src="{{ asset('images/logo.png') }}" alt="">
          @endif
          @if (!empty($product->images[4]->path))
            <img src="{{  asset($product->images[4]->path) }}" alt="">
          @else
            <img src="{{ asset('images/logo.png') }}" alt="">
          @endif
        </div>
        <div class="item--misc">
          <div class="item--details">
            <!-- product name  -->
            <p class="item--name">{{ $product->name }}</p>
            <!-- product description  -->
            <p class="item--price">
              <span class="item-title">Description</span>
              <p>{{ $product->desc }}</p>
            </p>
            <div class="item--size" id="custom-select">
              <!-- submit size based on what the client picks  -->
              <p class="item-title">Size: </p>
              <div>
                <button class="select-btn">XS</button>
                <button class="select-btn">S</button>
                <button class="select-btn">M</button>
                <button class="select-btn">L</button>
                <button aria-current="true" class="select-btn">XL</button>
              </div>
            </div>
            <!-- product price  -->
            <p class="item--price">
              <span class="item-title">Price</span>
              <span>&#x20a6 {{ number_format($product->price) }}</span>
            </p>
            <!-- product color  -->
            <div class="item--price">
              <p class="item-title">Color</p>
              <!-- put color in data attribute to change the color  -->
              <div style="display: flex; align-items: center;">
                {{ ucfirst(strtolower($product->color)) }}
                <span style="margin-left:10px; display: inline-block; padding: 1rem 1rem; border-radius: 0.25rem; background-color: {{strtolower($product->color)}}; font-weight: bold; text-decoration: none;"></span>
            </div>
            </div>
          </div>
          <div class="item--actions">
            <p class="item-title">Quantity</p>
            <div class="item--order-actions">
                <div>
                    <div class="order-count">
                        <button class="decrement" id="decrement"> - </button>
                        <span class="display-order-count" id="display-order-count">1</span>
                        <button class="increment" id="increment">+</button>
                      </div>
                    </div>
            </div>
          </div>
          
          <form action="/cart/add" method="post" class="item--actions" id="productOrderForm">
            @csrf
            <input type="hidden" name="size" value="M" id="select">
            <input type="text" hidden value="1" name="quantity" style="display: none;" id="order-number">
            <input type="text" hidden value="{{ $product->id }}" name="product_id">
            <button type="submit">Add to Cart </button>
          {{-- </form>
          <form action="/billing" method="post" class="item--actions" id="productOrderForm">
            <input type="hidden" name="size" value="M" id="select">
            <input type="text" hidden value="1" name="quantity" style="display: none;" id="order-number">
            <input type="text" hidden value="{{ $product->id }}" name="product_id">
            <button type="submit">Buy Now</button>
          </form> --}}
        </div>
      </div>
      <!-- <dialog id="modal" class="modal">
        <p>We hope you love your new look. Your feedback helps us to continue to bring you the best styles.</p>
        <div class="star-rating-send">
          <span>&#9733</span>
          <span>&#9733</span>
          <span>&#9733</span>
          <span>&#9733</span>
          <span>&#9733</span>
        </div>
        <form action="">
          <input id="setStarRating" hidden type="text" name="" id="">
          <button type="submit">Submit Review</button>
        </form>
        <button onclick="closeModal()">Close</button>
      </dialog> -->
    </section>

    <section class="product--section product-page">
      <h2 class="product--page-header">
        Related Products
      </h2>
      <div class="product--container">
        @foreach ($related_product as $related)
          <a href="/product/{{ $related->id }}" class="product--item">
            <div class="product--image-container">
              <img src="{{ asset($related->images->first()->path) }}" loading="lazy" alt="">
            </div>
            <div class="product--item--description">
              <p class="product--item--name">{{ $related->name }}</p>
              <p class="product--item--price">&#x20a6 {{ number_format($related->price) }}</p>
            </div>
          </a>
        @endforeach
      </div>
    </section>
  </main>
  @push('script')
  <script>
      const decrementButton = document.getElementById('decrement');
      const incrementButton = document.getElementById('increment');
      const displayOrderCount = document.getElementById('display-order-count');
      const orderNumberInput = document.getElementById('order-number');

      decrementButton.addEventListener('click', () => {
          const currentCount = parseInt(displayOrderCount.textContent);
          if (currentCount > 1) {
              displayOrderCount.textContent = currentCount - 1;
              orderNumberInput.value = currentCount - 1;
          }
      });

      incrementButton.addEventListener('click', () => {
          const currentCount = parseInt(displayOrderCount.textContent);
          displayOrderCount.textContent = currentCount + 1;
          orderNumberInput.value = currentCount + 1;
      });

      const selectBtn = document.querySelectorAll('.select-btn');
      const selectedSizeInput = document.getElementById('selectedSize');

      selectBtn.forEach(btn => {
          btn.addEventListener('click', () => {
              selectBtn.forEach(btn => btn.removeAttribute('aria-current'));
              btn.setAttribute('aria-current', 'true');
              selectedSizeInput.value = btn.textContent;
          });
      });
    </script>
  @endpush
</x-layout>