<x-layout>
  @push('title')| Products @endpush
  @push('style')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/flash-message.css') }}" />
    <style>
      .btn {
          padding: .65rem 1.4rem;
          font-size: 1rem;
          font-weight: 500;
          opacity: 1;
          border-radius: 3px;
      }
      .btn-round {
          border-radius: 100px !important;
      }
      .btn-label-info {
          background: rgba(72, 171, 247, .1);
          color: #48abf7 !important;
          border-color: transparent;
      }
    </style>
  @endpush
  <div class="filter--section container">
    <!-- this filter section filters the list of products by using js to check the tag if the value of the tag on the button data attribute matches the value of the category on the product attribute  -->
    <!-- you can do a for loop for all the categories and paste the category name in the data-tag attribute for filtering  -->
    <div class="d-flex mb-4">
      <div class="dropdown">
        <button class="filter--button me-5 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Sort By
        </button>
        @php
          $array = [];  
          if (count(request()->query()) > 0 && empty(request()->input('sort'))) {
            $array = request()->query();
            unset($array['sort']);
            $message = "&".http_build_query($array);
          } elseif (count(request()->query()) > 1 && !empty(request()->input('sort'))) {
            $array = request()->query();
            unset($array['sort']);
            $message = "&".http_build_query($array);
          } elseif (count(request()->query()) == 1 && !empty(request()->input('sort'))) {
            unset($array['sort']);
            $message = "";
          } else {
            $message = "";
          }
        @endphp
        <ul class="dropdown-menu dropdown-menu-lg" aria-labelledby="dropdownMenuButton1">
            <li class="border-bottom px-2">
              <a class="dropdown-item" href="/products?sort=date-asc{{ $message }}">Newest product first</a>
            </li>
            <li class="border-bottom p-2">
              <a class="dropdown-item" href="/products?sort=date-desc{{ $message }}">Oldest product first</a>
            </li>
            <li class="border-bottom pt-2 px-2">
              <a class="dropdown-item" href="/products?sort=name-asc{{ $message }}">Name A &RightArrow; Z </a>
            </li>
            <li class="border-bottom pt-2 px-2">
              <a class="dropdown-item" href="/products?sort=name-desc{{ $message }}">Name Z &RightArrow; A</a>
            </li>
            <li class="border-bottom pt-2 px-2">
              <a class="dropdown-item" href="/products?sort=price-asc{{ $message }}">Lowest price first</a>
            </li>
            <li class="pt-2 px-2">
              <a class="dropdown-item" href="/products?sort=price-desc{{ $message }}">Highest price first</a>
            </li>
        </ul>
      </div>
      <div>
        <form action="{{ route('products') }}" method="get">
          <div class="input-group">
            <input name="search" type="text" class="flex-grow-1  form-control" placeholder="Search by name or tag" aria-label="Search">
            <div class="input-group-append">
              <button class="filter--button" style="border-bottom-left-radius: 0px; border-top-left-radius: 0px;" type="submit">Search</button>
            </div>
          </div> 
        </form>
      </div>
    </div>
    <div class="dropdown">
      <button class="filter--button me-5 dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
          Filter by tags
      </button>
      <div class="dropdown-menu dropdown-menu-lg" style="border: none" aria-labelledby="dropdownMenuButton2">
        <div class="filter--wrapper" style="scroll-behavior: auto">
          <a class="filter--button" data-tag="all" aria-current="true" href="/products">All</a>
          @php
            $array = [];
            if (count(request()->query()) > 0 && empty(request()->input('tag'))) {
              $array = request()->query();
              unset($array['tag']);
              $data = "&".http_build_query($array);
            } elseif (count(request()->query()) > 1 && !empty(request()->input('tag'))) {
              $array = request()->query();
              unset($array['tag']);
              $data = "&".http_build_query($array);
            } elseif (count(request()->query()) == 1 && !empty(request()->input('tag'))) {
              unset($array['tag']);
              $data = "";
            } else {
              $data = "";
            }  
          @endphp
          @foreach ($tags as $tag)
            <a class="filter--button" data-tag="all" href="/products?tag={{ $tag.$data }}">{{ $tag }}</a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <section class="product--section container product-page">
    <h2 class="product--page-header">
      All Products
    </h2>
    <div class="product--container">
      @foreach ($all_products as $product)
        <a href="/product/{{ $product->id }}" class="product--item">
          <div class="product--image-container">
            @php
                if (!empty($product->images->first())) {
                  $image = '<img src="'.asset($product->images->first()->path).'" style="object-fit: contain; border-radius:10px" loading="lazy" alt="'.$product->name.'">';
                } else {
                  $image = '<img src="'.asset('images/logo.png').'" loading="lazy" alt="">';
                }
            @endphp
            {!! $image !!}
          </div>
          <div class="product--item--description">
            <p class="product--item--name">{{ $product->name }}</p>
            <p class="product--item--price">&#x20a6 {{ number_format($product->price) }}</p>
          </div>
        </a>
      @endforeach
    </div>
  </section>
  <div class="pagination__container">{{ $all_products->appends(request()->except('page'))->links('pagination::default') }}</div>
  <section class="product--section container product-page">
    <h2 class="product--page-header">
      Latest Products
    </h2>
    <div class="product--container">
      <!-- paste category of the product here in the data-category for the filtering to work  -->
      @foreach ($latest_product as $product)
        <a href="/product/{{ $product->id }}" class="product--item">
          <div class="product--image-container">
            @php
                if (!empty($product->images->first())) {
                  $image = '<img src="'.asset($product->images->first()->path).'" style="object-fit: contain; border-radius:10px" loading="lazy" alt="'.$product->name.'">';
                } else {
                  $image = '<img src="'.asset('images/logo.png').'" loading="lazy" alt="">';
                }
            @endphp
            {!! $image !!}
          </div>
          <div class="product--item--description">
            <p class="product--item--name">{{ $product->name }}</p>
            <p class="product--item--price">&#x20a6 {{ number_format($product->price) }}</p>
          </div>
        </a>
      @endforeach
    </div>
  </section>
  @push('script')
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  @endpush
</x-layout>