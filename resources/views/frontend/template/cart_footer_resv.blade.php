@if(!empty($cartProducts))
<div class="cart-total wow fadeInDown" id="cartFooter" data-wow-duration="1000ms" data-wow-delay="300ms">
    <div class="cart-total-title">
        <h5>CART TOTALS</h5>
    </div>
    <div class="product-cart-total">
        <small>Subtotal</small>
        <span>₹ {{ number_format($totalPrice, 2) }}</span>
    </div>
    <div class="product-cart-total">
        <small>Total shipping</small>
        <span>{{ !empty($setting->shipping_charge) ? '₹'.number_format( $setting->shipping_charge, 2 ) : 'FREE' }}</span>
    </div>
    <div class="grand-total">
        <h5>TOTAL <span>₹ {{ !empty($setting->shipping_charge) ? number_format( $totalPrice + $setting->shipping_charge, 2 ) : number_format( $totalPrice, 2 ) }}</span></h5>
    </div>
    <div class="proceed-check">

        <a href="{{ url('checkout_resv') }}" class="btn-primary-gold btn-medium">PROCEED TO CHECKOUT</a>
        
    </div>
</div>
@endif
