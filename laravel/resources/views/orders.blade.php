<x-layout :cart="$cart">
    @push('title')| My Orders @endpush
    @push('style')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/flash-message.css') }}" />
    <style>
        .order-details {
            border: 1px solid #ccc;
            padding: 1rem;
            background-color: #f5f5f5;
        }
        
        .order-details p {
            font-size: 14px;
            color: #666;
        }
        
        .order-details .order-id {
            font-weight: bold;
        }
    </style>
    @endpush
    <div class="d-flex container justify-content-center align-items-center">
        <div class="card w-75">
            <div class="card-header lead">
                Pending Orders
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($order_details as $order)
                        <li class="list-group-item">
                            <div class="order-details">
                                <p>Order ID: {{ $order['order_id'] }}</p>
                                <div class="accordion accordion-flush" id="accordionExample{{ $order['order_id'] }}">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="headingOne{{ $order['order_id'] }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $order['order_id'] }}" aria-expanded="true" aria-controls="collapseOne{{ $order['order_id'] }}">
                                          Details
                                        </button>
                                      </h2>
                                      <div id="collapseOne{{ $order['order_id'] }}" class="accordion-collapse collapse show" aria-labelledby="headingOne{{ $order['order_id'] }}" data-bs-parent="#accordionExample{{ $order['order_id'] }}">
                                        <div class="accordion-body">
                                            <ul class="list-group">
                                                @foreach ($order['order_item_details'] as $item)
                                                <li class="list-group-item order-details">#{{$item['product_count']}}</li>
                                                <li class="list-group-item">Name: {{$item['product_name']}}</li>
                                                <li class="list-group-item">Quantity: {{$item['quantity']}}</li>
                                                <li class="list-group-item">Size: {{$item['size']}}</li>
                                                <li class="list-group-item">
                                                    <div style="display: flex; align-items: center;">
                                                       Color: {{ ucfirst(strtolower($item['product_color'])) }}
                                                        <span style="margin-left:10px; display: inline-block; padding: 1rem 1rem; border-radius: 0.25rem; background-color: {{strtolower($item['product_color'])}}; font-weight: bold; text-decoration: none;"></span>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">Price: &#x20a6 {{ number_format($item['product_price']) }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="accordion-item"></div>
                                </div>
                                <p class="mt-4">Total Price: <b>&#x20a6 {{ number_format($order['total_price']) }} </b></p>
                                <p class="mt-4">Status: <b> {{ $order['status'] }} </b></p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @push('script')
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script>
        const accordions = document.querySelectorAll(".accordion-collapse");

        accordions.forEach(function (el) {
            el.addEventListener("show.bs.collapse", (event) => {
                // Close any previously opened accordion
                const openedAccordion = document.querySelector(".accordion-collapse.show");
                if (openedAccordion && openedAccordion !== el) {
                    openedAccordion.classList.remove("show");
                }
            });
        });

        // Initially close all accordions
        accordions.forEach(function (el) {
        el.classList.remove("show");
        });
    </script>
    @endpush
  </x-layout>