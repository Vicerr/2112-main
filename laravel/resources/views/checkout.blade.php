<x-layout :cart="$cart">
  @push('title')| Checkout @endpush
  <main class="container checkout">
    <div class="wrapper">
      <!-- submit clients address details if he chooses to order by delivery -->
      <form action="{{ route('checkout') }}" method="POST" class="billing-address" id="order-form">
        @csrf
        @method('POST')
        <div class="form-group">
          <input type="text" name="deliveryType" value="door_delivery" id="deliveryTypeInput" hidden>
        </div>
        <div class="form-group">
          <label for="information">Phone Number</label>
          <input type="tel" name="phone" placeholder="Pattern: +2340123456789" required ="">
        </div>
        @error('phone')
          <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
        @enderror
        <div class="delivery-method">
          <div class="delivery-type active" data-delivery-type="door_delivery">
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
      @error('address')
        <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
      @enderror
      @error('city')
        <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
      @enderror
      @error('landmark')
        <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
      @enderror
      <div class="order--section">
        <div class="order--summary-container" style="overflow-y: auto">
          @foreach ($items as $item)
          <div class="order--item">
            <div class="order--item-image-container">
              @if (!empty($item['image']))
                <img src=" {{ asset($item['image']) }}" alt="">
              @else
                <img src=" {{ asset(images/logo.png) }}" alt="">
              @endif
            </div>
            <div class="order--item-details">
              <p class="order--item-name">{{ ucfirst($item['product_name']) }}</p>
              <p class="order--item-quantity">Quantity: <span class="display-order-count"></span>{{ $item['quantity'] }}</span></p>
              <p class="order--item-size">Size: <span>{{ $item['size'] }}</span></p>
            </div>
            <p class="order--item-price">Price: &#8358 {{ number_format($item['product_price']) }}</p>
          </div>
          @endforeach
        <div class="order--cart-summary">
          <div class="details">
            <div>
              <p><b>Total</b></p>
              <p>&#8358 {{ number_format($total_price) }}</p>
            </div>
            
          </div>
        </div>
        <button onclick="submitBillingDetailsForm()">Complete Order</button>
      </div>
      
    </div>
  </main>
</x-layout>