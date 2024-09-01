<x-layout>
    @push('title')| Order @endpush
    @push('style')
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    @endpush
    @push('script')
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    @endpush
    <main class="container my-5">
      <div class="wrapper border py-3">
        <table class="table table-striped p-3">
            <thead>
                <tr>
                    <th class="ps-3">Product ID</th>
                    <th>Product Name</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customArray as $item)
                    <tr>
                        <td class="ps-5">{{ $item['product_id'] }}</td>
                        <td>{{ $item['product_name'] }}</td>
                        <td>{{ $item['product_color'] }}</td>
                        <td>{{ $item['size'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>&#x20a6 {{ number_format($item['product_price'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            <p class="lead px-3">Total Price: <b>&#x20a6 {{ number_format($total_price, 2) }}</b></p>
            <hr>
            <p class="lead px-3">Created: <b>{{ date('j-m-Y', strtotime($created_at)) }}</b> </p>    
        </div>
      </div>
    </main>
  </x-layout>