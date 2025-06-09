@if (!empty($cartProducts))
    <div class="cart-total wow fadeInDown" style="float: left; max-width: 630px;" data-wow-duration="1000ms"
        data-wow-delay="300ms">
        @if (Auth()->user())
            <?php
            $coupan = session()->get('coupon');
            $point = session()->get('point');
            $authpoint = App\Models\User::with('point')->find(Auth::user()->id);
            ?>
            @if (empty($coupan))
                <div class="cupon-part">
                    <input type="text" id="coupon_code" placeholder="Coupon Code" style="margin-top: 25px;">
                </div>
                <button type="button" class="btn-medium btn-dark-coffee apply_coupon"
                    data-url="{{ url('ajax/check-coupon') }}">Apply Coupon</button>
            @endif
            <span id="massege"></span>
            @if (!empty($authpoint->point))
                <div>
                    @if (!empty($point))
                        <input type="checkbox" name="use_point" readonly="readonly" class="remove_point"
                            data-url="{{ url('/removepoint') }}" checked style="margin: 0; margin-right: 10px;"> Use
                        Point
                    @else
                        <input type="checkbox" name="use_point" readonly="readonly" class="apply_point"
                            data-url="{{ url('/checkpoint') }}" style="margin: 0; margin-right: 10px;"> Use Point
                    @endif
                </div>
            @else
                <div>
                    <input type="checkbox" name="use_point" disabled="disabled" class="apply_point"
                        data-url="{{ url('/checkpoint') }}" style="margin: 0; margin-right: 10px;"> Use Point
                </div>
            @endif
        @endif
    </div>
    <div class="cart-total wow fadeInDown" id="cartFooter" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="cart-total-title">
            <h5>CART TOTALS</h5>
        </div>
        <div class="product-cart-total">
            <small>Subtotal</small>
            <span>₹ {{ number_format($totalPrice, 2) }}</span>
        </div>
        <?php
        $coupan = session()->get('coupon');
        $point = session()->get('point');
        $pointsetting = App\Model\PointApply::find(1);
        ?>
        @if (Auth()->user())
            @if (!empty($coupan))
                @if ($coupan->discount_type == 'Flat')
                    <?php
                    $Discount = $coupan->discount;
                    ?>
                @else
                    <?php
                    $Discount = $totalPrice * ($coupan->discount / 100);
                    if ($coupan->upto != '') {
                        if ($Discount > $coupan->upto) {
                            $Discount = $coupan->upto;
                        }
                    }
                    ?>
                @endif
                <div class="product-cart-total">
                    <small>Discount</small>
                    <span>{{ !empty($Discount) ? '₹' . number_format($Discount, 2) : '₹' . number_format($Discount, 2) }}</span>
                    <br>
                    <small style="color: green;">"{{ $coupan->code }}" Applied!</small>
                    <span class="remove-coupan del-coupan" data-url="{{ url('ajax/remove-coupon') }}">Remove <i
                            class="fa fa-remove"></i></span>
                </div>
            @endif
            @if (!empty($point))
                <?php
                $pDis = ($pointsetting->use_point / 100) * $point->point;
                $pointDis = $pDis / $pointsetting->point_value;
                ?>
                <div class="product-cart-total">
                    <small>Points Discount</small>
                    <span>{{ !empty($pointDis) ? '₹' . number_format($pointDis, 2) : '₹' . number_format($pointDis, 2) }}</span>
                    <br>
                    <small style="color: green;">{{ $pDis }} Point Used!</small>
                </div>
            @endif
        @endif
        <div class="product-cart-total">
            <small>Total shipping</small>
            <span>{{ !empty($setting->shipping_charge) ? '₹' . number_format($setting->shipping_charge, 2) : 'FREE' }}</span>
        </div>

        <div class="grand-total">
            @php
                if (!empty($Discount)) {
                    $totalPrice = $totalPrice - $Discount;
                }
                if (!empty($pointDis)) {
                    $totalPrice = $totalPrice - $pointDis;
                }
            @endphp
            <h5>TOTAL <span>₹
                    {{ !empty($setting->shipping_charge) ? number_format($totalPrice + $setting->shipping_charge, 2) : number_format($totalPrice, 2) }}</span>
            </h5>
        </div>
        <div class="proceed-check">
            @guest()
                <a href="javascript:user_login()" class="btn-primary-gold btn-medium">PROCEED TO CHECKOUT</a>
            @else
                <a href="{{ url('checkout') }}" class="btn-primary-gold btn-medium">PROCEED TO CHECKOUT</a>
    @endif

    @guest()
        <a href="{{ url('guest') }}" class="btn-primary-gold btn-medium">Continue as Guest</a>
    @else
        <a href=""></a>
        @endif

        </div>
        </div>
        @endif
