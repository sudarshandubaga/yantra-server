@php
    $cart = session()->get('cart');
    $cartProducts = [];
    $totalPrice   = 0;
    if(!empty($cart)) {
        foreach($cart as $pid => $pData) {
            $productInfo = \App\Model\MenuItem::with('media')->find( $pid );
            if(!empty($productInfo->id)) {
                $productInfo->qty   = $pData['qty'];
                $cartProducts[]     = $productInfo;
                $totalPrice        += $productInfo->sale_price * $pData['qty'];
            }
        }
    }
@endphp

@if( !empty($cartProducts) )
<a href="{{url('cart')}}"><img src="{{url('imgs/icon-basket.png')}}" alt="">{{ count($cartProducts) }} items <span class="item_price">- ₹{{ number_format($totalPrice, 2) }}</span></a>

<div class="cart-wrap">
    <div class="cart-blog">
        @foreach($cartProducts as $cp)
        <div class="cart-item">
            <div class="cart-item-left">
                <img src="{{ url('storage/media/'.$cp->media->media) }}" alt="">
            </div>
            <div class="cart-item-right">
                <h6>{{ $cp->name }}</h6>
                <span>₹{{ number_format($cp->sale_price) }} x {{ $cp->qty }}</span>
            </div>
            <span class="delete-icon cart-remove-icon" data-pid="{{ $cp->id }}" data-url="{{ url('cart/remove') }}"></span>
        </div>
        @endforeach
        <div class="subtotal">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h6>Subtotal :</h6>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <span>₹{{ number_format($totalPrice, 2) }}</span>
            </div>
        </div>
        <div class="cart-btn">
            <a href="{{url('cart')}}" class="btn-black view">VIEW ALL</a>
            @guest()
            <a href="javascript:user_login()" class="btn-main checkout">CHECK OUT</a>
            @else
                <a href="{{ url('checkout') }}" class="btn-main checkout">CHECK OUT</a>
            @endif
        </div>
    </div>
</div>
@endif
