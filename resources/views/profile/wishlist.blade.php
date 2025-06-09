@extends('frontend.layout.master')

@section('title', 'My Wishlist')

@section('contant')

		<main>
    <div class="main-part">
        <!-- Start Breadcrumb Part -->
        <section class="breadcrumb-part menu-part" data-stellar-offset-parent="true" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('imgs/breadbg1.jpg') }}');">
            <div class="container">
                <div class="breadcrumb-inner">
                    <h2>Profile</h2>
					<a href="{{ url('/') }}">Home</a>
                    <a href="{{ route('profile') }}">Profile</a>
                    <a><span>My Wishlist</span></a>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Part -->
        <section class="home-icon login-register bg-skeen">
            <div class="icon-default icon-skeen">
                <img src="{{ url('imgs/scroll-arrow.png') }}" alt="">
            </div>
            <div class="container">
                <div class="row">
                    @include('profile.sidebar')
                    <div class="col-sm-8">
						<!-- <div class="panel">
							<div class="panel-body">
								<h3>My Wishlist</h3>
								<div class="table-responsive">
									<table class="table table-sm table-striped table-bordered">
										<thead>
											<tr>
												<th>#</th>
												<th>Product Name</th>
												<th>Price</th>
												<th>Description</th>
											</tr>
										</thead>
										<tbody>
											@foreach($lists as $i => $list)
											<tr>
												<td>{{ $sn++ }}.</td>
												<td>
													<img src="{{url('storage/media/thumb/'.$list->products->media->media)}}" alt="" style="max-height: 50px; border-radius: 8px;">
													{{ $list->products->name }}
												</td>
												<td>₹{{ $list->products->sale_price }}</td>
												<td>{{ $list->products->excerpt }}</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div> -->
						<div class="panel">
							<div class="panel-body mb-5">
								<h3>My Wishlist</h3>
					            <div class="col-md-12 col-xs-12 menu">
					        	@foreach($lists as $i => $list)
			                    <div class="shop-main-list menu-shd">
                                    <div class="removeToWishlist wis-remove-btn" data-url="{{ url('wishlistremove') }}" data-pid="{{ $list->products->id }}">
                                    	<i class="fa fa-times"></i>
                                    </div>

					            	<div class="row">
										<div class="col-md-4">
											<div class="shop-product" style="margin: 0; border-radius: 0;">
			                                	<img src="{{ url('storage/media/thumb/'.$list->products->media->media) }}" loading="lazy" alt="" style="height: auto;">
			                                </div>
										</div>
										<div class="col-md-8" style="margin-top: 15px; text-align: left;">
											<div class="row">
												<div class="col-xs-12 mb-3">
													<h5>{{ ucwords($list->products->name) }}</h5>
												</div>
												<div class="col-xs-12 mb-3">
													<p style="margin-bottom: 10px;">{!! substr($list->products->excerpt, 0, 50) !!}</p>
												</div>
												<div class="col-xs-12 mb-3">
													<h5>
														@if($list->products->regular_price > $list->products->sale_price)
														<s>₹{{ number_format( $list->products->regular_price ) }}</s>
														@endif
														<strong>₹{{ number_format( $list->products->sale_price ) }}</strong>
													</h5>
												</div>
												<div class="col-xs-6 mb-5">
													<button type="button" data-url="{{ url('cart/add') }}" data-pid="{{ $list->products->id }}" class="shop-wish-cart shop-cart-btn addToCartBtn">ADD TO CART</button>
												</div>
												<div class="col-xs-6 mb-5">
													<button type="button" data-url="{{ url('cart/add') }}" data-pid="{{ $list->products->id }}" class="shop-cart-btn addToCartBtnwithshow shop-wish-cart">BUY NOW</button>
												</div>
											</div>
										</div>
									</div>
			                    </div>
					            @endforeach
							</div>
						</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@stop
