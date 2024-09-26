@props(['cart'])

<div>
    <a href="{{ route('cart') }}" class="icon" style="margin-right: 15px" @if ($cart) data-counter="{{ $cart }}" @endif ><img src="{{ asset('images/icons/cart.svg') }}" alt=""></a href="">
</div>