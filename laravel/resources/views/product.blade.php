<x-layout>
  <main class="container">
    <section class="item--container">
      <div class="item--product-details">
        <div class="item--image-container">
          <!-- product images -->
          <img src="{{ asset('images/img-8365-6680864097911.webp') }}" alt="">
          <img src="{{ asset('images/img-8366-6680864396c7f.webp') }}" alt="">
          <img src="{{ asset('images/img-8366-6680864396c7f.webp') }}" alt="">
          <img src="{{ asset('images/img-8367-6680864396df8.webp') }}" alt="">

          <img class="wide" src="{{ asset('images/img-8366-6680864396c7f.webp') }}" alt="">
        </div>
        <div class="item--misc">
          <div class="item--details">
            <!-- product name  -->
            <p class="item--name">Product name</p>
            <div class="item--size" id="custom-select">
              <!-- submit size based on what the client picks  -->
              <p class="item-title">Size: </p>
              <div>
                <button class="select-btn">XS</button>
                <button class="select-btn">S</button>
                <button aria-current="true" class="select-btn">M</button>
                <button class="select-btn">L</button>
                <button class="select-btn">XL</button>
              </div>
            </div>
            <!-- product price  -->
            <p class="item--price">
              <span class="item-title">Price</span>
              <span>&#x20a6 4000</span>
            </p>
            <!-- product code  -->
            <div class="colors">
              <p class="item-title">Color</p>
              <!-- put color in data attribute to change the color  -->
              <p class="item-color" data-color="blue"></p>
            </div>
          </div>
          <form action="" class="item--actions" id="productOrderForm">
            <div class="item--colors">
              <!-- product color  -->

            </div>

            <input type="hidden" name="select-value" value="M" id="select">
            <p class="item-title">Quantity</p>
            <div class="item--order-actions">
              <div>
                <div class="order-count">
                  <button class="decrement" id="decrement"> - </button>
                  <!-- select quantity based on what the user chooses  -->
                  <span class="display-order-count" id="display-order-count">1</span>
                  <input type="text" hidden value="1" name="order-number" style="display: none;" id="order-number">
                  <button class="increment" id="increment">+</button>
                </div>

              </div>

            </div>


          </form>
          <form action="/orders/add-to-cart" method="post" class="item--actions" id="productOrderForm">
            <input type="hidden" name="size" value="M" id="select">
            <input type="text" hidden value="1" name="quantity" class="order-number">
            <input type="text" hidden value="<%= product.id %>" name="itemId">
            <button class="invert" type="submit">Add to Cart </button>

          </form>
          <form action="/orders/place-order" method="post" class="item--actions" id="productOrderForm">
            <input type="hidden" name="size" value="M" id="select">
            <input type="text" hidden value="<%= product.id %>" name="itemId">

            <input type="text" hidden value="1" name="quantity" class="order-number">
            <button type="submit" onclick="submitProductOrderForm()">Buy Now</button>

          </form>
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
        <!-- filter products based on items with the same tag -->
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
    </section>
  </main>
</x-layout>