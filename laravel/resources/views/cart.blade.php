<x-layout>
  <main class="container">
    <div class="wrapper">
      <section class="cart--section">
        <div class="cart--card" id="cart-card-<%= item.item._id %>">
          <div class="cart--card--image-container"><img src=" {{ asset('images/img-8337-6680861cdabff.webp') }}" alt=""></div>
          <div class="cart--card--details">
            <p class="cart--item-name">product name</p>
            <div class="cart--item-specification">
              <p>Quantity: <span class="display-order-count" id="display-order-count-<%= item.item._id %>"></span> 1</span></p>
              <p>Size: <span>M</span></p>
              <!-- <p>Color: <span>blue</span></p> -->
            </div>
            <p class="cart--item-price">Price: &#8358 400

            </p>
            <div class="item--order-actions">
              <div class="order-count cart">
                <button class="decrement" data-item-id="<%= item.item._id %>" id="decrement-<%= item.item._id %>"> - </button>
                <p>
                  <span class="display-order-count" id="display-order-count-quantity-<%= item.item._id %>">1</span>
                </p>
                <button class="increment" data-item-id="<%= item.item._id %>" id="increment-<%= item.item._id %>"> + </button>
              </div>
            </div>
          </div>
          <form action="/orders/<%= item.item._id %>/delete?_method=DELETE" method="POST" class="delete-item-form">
            <button type="submit" class="delete-item">x</button>
          </form>
        </div>
        <div class="cart--card">
          <div class="cart--card--image-container"><img src=" {{ asset('images/img-8336-6680861d35809.webp') }}" alt=""></div>
          <div class="cart--card--details">
            <p class="cart--item-name">Claudette Corset Dress in White</p>
            <div class="cart--item-specification"></div>
            <p class="cart--item-price">$$333</p>
          </div>
          <a href="" class="delete-item">x</a>
        </div>
        <div class="cart--card">
          <div class="cart--card--image-container"><img src=" {{ asset('images/img-8336-6680861d35809.webp') }}" alt=""></div>
          <div class="cart--card--details">
            <p class="cart--item-name">Claudette Corset Dress in White</p>
            <div class="cart--item-specification"></div>
            <p class="cart--item-price">$$333</p>
          </div>
          <a href="" class="delete-item">x</a>
        </div>
        <div class="cart--card">
          <div class="cart--card--image-container"><img src=" {{ asset('images/img-8336-6680861d35809.webp') }}" alt=""></div>
          <div class="cart--card--details">
            <p class="cart--item-name">Claudette Corset Dress in White</p>
            <div class="cart--item-specification"></div>
            <p class="cart--item-price">$$333</p>
          </div>
          <a href="" class="delete-item">x</a>
        </div>

      </section>
      <section class="cart--summary">
        <div class="first-details">
          <p><span>Total Price </span><span><span>&#8358</span> <span> 400</span></span></p>
          <p><span>Discount</span> <span>£0</span></p>
          <p><span>Estimated Delivery Fee</span> <span>free</span></p>
        </div>
        <div class="second-details">
          <p><span>Total Price:</span><span><span>&#8358</span> <span>400</span></span></p>
          <p class="text-secondary"><span>Savings Applied</span> <span>£3300</span></p>
          <!-- <form action="/checkout" method="post"> -->
          <button style="padding: 0;" type="submit"><a style="display: block; text-decoration: none; color: white; padding-block: 1em;" href="/checkout" class="cart-btn">Checkout</a></button>
          <!-- </form> -->
          <form action="/orders/clear-orders" method="post" id="clear-orders-form">
            <button type="submit" id="clear-orders-button" class="cart-btn">Clear Orders</button>
          </form>
        </div>
      </section>
    </div>
  </main>
</x-layout>