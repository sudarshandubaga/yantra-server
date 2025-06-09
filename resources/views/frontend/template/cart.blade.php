@if(!empty($cartProducts))
    <table class="shop-cart-table">
        <thead>
            <tr>
                <th>PRODUCT</th>
                <th>PRICE</th>
                <th>QUANTITY</th>
                
                <th>JAIN FOOD</th>
                
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartProducts as $cp)
            <tr>
                <th>PRODUCT</th>
                <td>
                    <div class="product-cart">
                        <img src="{{url('storage/media/thumb/'.$cp->media->media)}}" alt="" style="max-height: 100px;">
                    </div>
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
                        <input name="qty[{{ $cp->id }}]" value="{{ $cp->qty }}" type="text">
                        <span class="plus-text"><i class="icon-plus"></i></span>
                    </div>
                </td>
                <th>JAIN FOOD</th>
                @if($cp->jain_food==1)
                    <td>
                        <input type="checkbox" name="jain_food[{{ $cp->id }}]" value="1" style="margin-bottom: 3px; margin-top: 0;" @if(@$cp->is_jain_food) checked @endif> Yes
                    </td>
                @else
                    <td>
                        Not Available
                    </td>
                @endif
                <th>TOTAL</th>
                <td>
                    ₹ {{ $cp->sale_price * $cp->qty }}
                </td>
                <td class="shop-cart-close" data-pid="{{ $cp->id }}" data-url="{{ url('cart/remove') }}"><i class="icon-cancel-5"></i></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="product-cart-detail">
        <button type="button" class="btn-medium btn-skin pull-right updateCartBtn">UPDATE CART</button>
    </div>
    
@else
    Cart is empty.
@endif
