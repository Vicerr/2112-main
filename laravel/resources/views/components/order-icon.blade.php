@props(['cart'])

<div>
    <a href="{{ route('order.status') }}" class="icon" @if ($cart) data-counter="{{ $cart }}" @endif ><img src="{{ asset('images/icons/envelope.svg') }}" alt=""></a href="">
</div>