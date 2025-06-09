<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
        <div class="slider slider-for slick-shop">

            
            <div>
                <img src="{{ url('storage/media/thumb/'.$menu->media->media) }}" loading="lazy" alt="">
            </div>
        
            <div class="share-tag">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 mt-1">
                        <div class="social-wrap">
                            <h5 class="h5">SHARE :</h5>
                            <ul class="social">
                                <li class="social-facebook">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('menuinfo', $menu->id) }}" target="_blank">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li class="social-tweeter">
                                    <a href="https://twitter.com/home?status={{ route('menuinfo', $menu->id) }}" target="_blank">
                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
        <h4 class="text-coffee" style="margin: 0;">{{ $menu->name }}</h4>
        <p class="m-0">{{ $menu->excerpt }}</p>
        <div class="row">
            <div class="col-xs-6 col-md-12 col-sm-12">
                <h3 class="text-coffee">
                    @if($menu->regular_price > $menu->sale_price)
                        <s style="color: #ebebeb;">₹{{ $menu->regular_price }}</s>
                    @endif
                    
                    ₹{{ $menu->sale_price }}
                </h3>
            </div>
            <div class="col-xs-6 col-md-12 col-sm-12">
                <div class="price-textbox">
                    <span class="minus-text"><i class="icon-minus"></i></span>
                    <input type="text" name="txt" value="1" pattern="[0-9]" readonly>
                    <span class="plus-text"><i class="icon-plus"></i></span>
                </div>
            </div>
        </div>
        <div>
            <button type="button" id="menuSlidercart" class="filter-btn btn-large addToCartBtnSingle" data-url="{{ url('cart/add') }}" data-pid="{{ $menu->id }}" style="margin-left: 0; width: 100%;">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i> Add Cart
            </button>
            <button type="button" class="filter-btn btn-large addToCartBtnSinglewithshow" data-url="{{ url('cart/add') }}" data-pid="{{ $menu->id }}" style="width: 100%;">
                <i class="fa fa-shopping-bag" aria-hidden="true"></i> BUY NOW
            </button>
        </div>
        
    </div>
</div>