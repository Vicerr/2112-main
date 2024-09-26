<x-layout :cart="$cart">
  @push('title')| Cart @endpush
  @push('style')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/flash-message.css') }}" />
    <style>
      .btn-label-info {
          outline: rgba(72, 171, 247, .1) solid 3px;
          background: rgba(72, 171, 247, .1);
          color: #48abf7 !important;
          border-color: transparent;
        }
    </style>
  @endpush
  <main class="container">
    <div class="wrapper">
      <section class="cart--section">
        @foreach ($items as $item)
          <div class="cart--card">
            @if (!empty($item['image']))
              <div class="cart--card--image-container"><a href="product/{{ $item['product_id'] }}"><img src=" {{ asset($item['image']) }}" alt=""></a></div>
            @else
              <div class="cart--card--image-container"><a href="product/{{ $item['product_id'] }}"><img src=" {{ asset(images/logo.png) }}" alt=""></a></div>
            @endif
            <div class="cart--card--details">
              <p class="cart--item-name mb-0"><b>{{ ucfirst($item['product_name']) }}</b></p>
              <div class="cart--item-specification">
                <p class=" mb-0">Quantity: <span class="display-order-count"></span>{{ $item['quantity'] }}</span></p>
                <p class=" mb-0">Size: <span>{{ $item['size'] }}</span></p>
                <!-- <p>Color: <span>blue</span></p> -->
              </div>
              <p class="cart--item-price  mb-0">Price: &#8358 {{ number_format($item['product_price']) }}</p>
              <button type="button" class="btn btn-label-info" data-toggle="modal" data-target="#exampleModalCenter{{ $item['order_item_id'] }}"> Edit </button>
              
              <!-- Modal -->
              <div class="modal fade" id="exampleModalCenter{{ $item['order_item_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle{{ $item['order_item_id'] }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle{{ $item['order_item_id'] }}">Edit Cart Item</h5>
                      <button type="button" class="btn btn-outline-dark close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-times"></i></span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="item--size" id="custom-select">
                        <form action="{{ route('cart.update', ['cart' => Crypt::encryptString($item['order_item_id'])]) }}" method="POST">
                          @csrf
                          @method('PUT')
                        <!-- submit size based on what the client picks  -->
                        <p class="item-title"><b>Size:</b> </p>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="size" value="XS">XS
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="size" value="S">S
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="size" value="M">M
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="size" value="X">X
                          </label>
                        </div>
                        <div class="form-check form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="size" value="XL">XL
                          </label>
                        </div>
                        @error('size')
                          <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
                        @enderror
                      </div>
                      <div class="item--actions">
                        <p class="item-title"><b>Quantity</b></p>
                        <div class="item--order-actions">
                          <div>
                            <div class="order-count" id="{{ $item['order_item_id'] }}">
                              <button type="button" class="decrement" id="{{ $item['order_item_id'] }}-decrement"> - </button>
                              <span class="display-order-count" id="{{ $item['order_item_id'] }}-display-order-count">1</span>
                              <button type="button" class="increment" id="{{ $item['order_item_id'] }}-increment">+</button>
                            </div>
                          </div>
                        </div>
                        @error('quantity')
                          <small style="color:red; display:block; font-style:italic; justify-self: start; margin: 10px 0px 0px 10px;">{{$message}}</small>
                        @enderror
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="text" hidden value="1" name="quantity" style="display: none;" id="{{ $item['order_item_id'] }}-order-number">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <form action="{{ route('cart.delete', ['cart' => Crypt::encryptString($item['order_item_id'])]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="close delete-item">&times;</button>
            </form>
          </div>
        @endforeach

      </section>
      <section class="cart--summary">
        <div class="first-details">
          <p><span>Total Price </span><span><span>&#8358</span><span>{{ number_format($total_price) }}</span></span></p>
          <p><span>Discount</span> <span>₦0.00</span></p>
          <p><span>Estimated Delivery Fee</span> <span>free</span></p>
        </div>
        <div class="second-details">
          <p><span>Total Price:</span><span><span>&#8358</span><span>{{ number_format($total_price) }}</span></span></p>
          {{-- <p class="text-secondary"><span>Savings Applied</span> <span>£3300</span></p> --}}
          <!-- <form action="/checkout" method="post"> -->
          <button style="padding: 0;" type="submit"><a style="display: block; text-decoration: none; color: white; padding-block: 1em;" href="{{ route('billing') }}" class="cart-btn">Checkout</a></button>
          <!-- </form> -->
          <form action="{{ route('cart.clear') }}" method="POST" id="clear-orders-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="cart-btn">Clear Orders</button>
          </form>
        </div>
      </section>
    </div>
  </main>
  @push('script')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
      function decrement(divId) {
          const currentCount = parseInt(document.getElementById(divId + '-display-order-count').textContent);
          if (currentCount > 1) {
              document.getElementById(divId + '-display-order-count').textContent = currentCount - 1;
              document.getElementById(divId + '-order-number').value = currentCount - 1;
          }
      }

      function increment(divId) {
          const currentCount = parseInt(document.getElementById(divId + '-display-order-count').textContent);
          document.getElementById(divId + '-display-order-count').textContent = currentCount + 1;
          document.getElementById(divId + '-order-number').value = currentCount + 1;
      }

      // Attach event listeners to each div
      document.querySelectorAll('.order-count').forEach(div => {
          const divId = div.id;

          div.querySelector('.decrement').addEventListener('click', () => decrement(divId));
          div.querySelector('.increment').addEventListener('click', () => increment(divId));
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