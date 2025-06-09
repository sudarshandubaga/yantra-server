@php 
	$cart = session()->get('cart_resv');
        $cartProducts = [];
        $totalPrice   = 0;
        if (!empty($cart)) {
            foreach ($cart as $pid => $pData) {
                $productInfo = \App\Model\MenuItem::with('media')->find($pid);
                if (!empty($productInfo->id)) {
                    $productInfo->qty   = $pData['qty'];
                    $productInfo->is_jain_food   = $pData['is_jain_food'] ?? 0;
                    $cartProducts[]     = $productInfo;
                    $totalPrice        += $productInfo->sale_price * $pData['qty'];
                }
            }
        }

        $setting = App\Model\Setting::findOrFail(1);

 @endphp
<div class="cart-section">
				                <div class="checkout-wrap wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" style="padding: 0;">
				                	<ul style="background-color: #20202f;">
				                		<li style="font-size: 20px; color: white; padding: 10px 0px;">Reservation Table Cart</li>
				                	</ul>
				                </div>
				                <div class="shop-cart-list wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" style="padding: 20px;">
									<form action="{{ url('cart_resv/update') }}" method="post" id="cartResponse">
										<!-- @include('frontend.template.cart_resv', compact('cartProducts')) -->
										@if(!empty($cartProducts))
										    <table class="shop-cart-table" style=" font-size: 14px;">
										        <thead>
										            <tr>
										                <th style="padding-left: 10px">PRODUCT</th>
										                <th>PRICE</th>	
										                <th>QUANTITY</th>
										                
										                <th>JAIN</th>
										                
										                <th style="padding-right: 10px">TOTAL</th>
										            </tr>
										        </thead>
										        <tbody>
										            @foreach($cartProducts as $cp)
										            <tr>
										                <th>PRODUCT</th>
										                <td>
										                    <div class="product-cart-title">
										                        <span>{{ $cp->name }}</span>
										                    </div>
										                </td>
										                <th>PRICE</th>
										                <td>
										                    <strong>₹ {{ $cp->sale_price }}</strong>
										                    <del>₹ {{ $cp->regular_price }}</del>
										                </td>
										                <th>QUANTITY</th>
										                <td>
										                    <div class="price-textbox">
										                        <span class="minus-text"><i class="icon-minus"></i></span>
										                        <input style="" name="qty[{{ $cp->id }}]" value="{{ $cp->qty }}" type="text">
										                        <span class="plus-text"><i class="icon-plus"></i></span>
										                    </div>
										                </td>
										                <th>JAIN FOOD</th>
										                @if($cp->jain_food==1)
										                    <td class="text-center">
										                        <input type="checkbox" name="jain_food[{{ $cp->id }}]" value="1" style="margin-bottom: 3px; margin-top: 0;" @if(@$cp->is_jain_food) checked @endif> Yes
										                    </td>
										                @else
										                    <td>
										                        Not Available
										                    </td>
										                @endif
										                <th>TOTAL</th>
										                <td class="text-center">
										                    ₹ {{ $cp->sale_price * $cp->qty }}
										                </td>
										                <td class="shop-cart_resv-close" data-pid="{{ $cp->id }}" data-url="{{ url('cart_resv/remove') }}"><i class="icon-cancel-5"></i></td>
										            </tr>
										            @endforeach
										        </tbody>
										    </table>
										    <div class="product-cart-detail">								        
										        <button type="button" class="btn-medium btn-skin pull-right updateCart_resvBtn">UPDATE CART</button>
										    </div>
										@else
										    Cart is empty.
										@endif

									</form>
				                </div>

								<div id="cartFooter">
									<!-- @include('frontend.template.cart_footer_resv', compact('totalPrice', 'setting', 'cartProducts')) -->
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

								</div>
            			</div>