<x-layout>
  <main class="container checkout">
    <div class="wrapper">
      <!-- submit clients address details if he chooses to order by delivery -->
      <form action="" class="billing-address" id="order-form">
        @csrf
        <div class="form-group">
          <label for="information">Customer Information</label>
          <input type="text" name="email" id="">
        </div>
        <div class="form-group">
          <input type="text" name="deliveryType" id="deliveryTypeInput" hidden>
        </div>
        <div class="delivery-method">
          <div class="delivery-type active" data-delivery-type="deliver">
            <img class="delivery-tick" src="{{ asset('images/icons/tick.svg') }}" alt="">
            <p class="delivery-heading">Home Delivery</p>
            <p class="delivery-details">Delivery within 2 - 5 business days</p>
          </div>
          <div class="delivery-type" data-delivery-type="pickup">
            <img class="delivery-tick" src="{{ asset('images/icons/tick.svg') }}" alt="">
            <p class="delivery-heading">In-store Pickup</p>
            <p class="delivery-details">Pickup at our store at 123 Close Eliozu, Port Harcourt, Nigeria.</p>
          </div>
        </div>
      </form>
      <div class="order--section">
        <div class="order--summary-container">

          <div class="order--item">
            <div class="order--item-image-container">
              <img src="{{ asset('images/img-8337-6680861cdabff.webp') }}" alt="">
            </div>
            <div class="order--item-details">
              <p class="order--item-name">Styled Senator</p>
              <p class="order--item-quantity">2</p>
              <p class="order--item-size">m</p>
            </div>
            <p class="order--item-price">$50</p>
          </div>
          <div class="order--item">
            <div class="order--item-image-container">
              <img src="{{ asset('images/img-8336-6680861d35809.webp') }}" alt="">
            </div>
            <div class="order--item-details">
              <p class="order--item-name">Brown Butterfly Senator</p>
              <p class="order--item-quantity">1</p>
              <p class="order--item-size">l</p>
            </div>
            <p class="order--item-price">$50</p>
          </div>
        </div>
        <div class="order--cart-summary">
          <div class="details">
            <div>
              <p><b>Total</b></p>
              <p>$20</p>
            </div>

          </div>
        </div>
        <button onclick="submitBillingDetailsForm()">Complete Order</button>
      </div>

    </div>
  </main>
</x-layout>