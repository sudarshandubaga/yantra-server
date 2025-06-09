@extends('frontend.layout.master')

@section('title', 'Order Details')

@section('contant')

    <main>
        <div class="main-part">
            <!-- Start Breadcrumb Part -->
            <section class="breadcrumb-part menu-part" data-stellar-offset-parent="true" data-stellar-background-ratio="0.5"
                style="background-image: url('{{ url('imgs/breadbg1.jpg') }}');">
                <div class="container">
                    <div class="breadcrumb-inner">
                        <h2>Order Details</h2>
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ route('profile') }}">Profile</a>
                        <a href="{{ route('my_orders') }}">My Orders</a>
                        <a><span>Order Details</span></a>
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
                            <div class="panel mb-5">
                                <div class="panel-body" style="min-height: 427px">
                                    <a href="{{ route('my_orders') }}" class="pull-right" title="Edit"
                                        data-toggle="tooltip"><i class="icon-arrow-left2 icomoon"></i> Back</a>
                                    <h3>Order Information</h3>
                                    <div class="row mb-5">
                                        <div class="col-xs-6 col-md-3">
                                            <strong>Order ID</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            {{ sprintf('#%06d', $order->id) }}
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            <strong>Invoice No.</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            {{ "{$setting->invoice_prefix}/{$order->financial_year}/" . sprintf('%04d', $order->invoice_no) }}
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-xs-6 col-md-3">
                                            <strong>Date & Time</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            {{ $order->created_at->format('M d, Y h:i A') }}
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            <strong>Schedule Date & Time</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            {{ $order->schedule_date }} {{ $order->schedule_time ?? 'N/A' }}
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-xs-6 col-md-3">
                                            <strong>Status</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            {{ $order->status }}
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            <strong>Payment Status</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            {{ $order->payment_status }}
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-xs-6 col-md-3">
                                            <strong>Total Amount</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            ₹{{ $order->total_amount }}
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            <strong>Payment Mode</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            {{ $order->payment_mode }}
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-xs-6 col-md-3">
                                            <strong>Notes</strong>
                                        </div>
                                        <div class="col-xs-6 col-md-3">
                                            {{ $order->notes ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body mb-5">
                            <div class="table-responsive">
                                <table class="shop-cart-table">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT</th>
                                            <th class="text-center">PRICE</th>
                                            <th class="text-center">QUANTITY</th>
                                            <th class="text-center">JAIN FOOD</th>
                                            <th class="text-center">TOTAL</th>
                                            @if ($order->status == 'Delivered')
                                                <th class="text-center">RATE</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach ($order->products as $i => $p)
                                            @php
                                                $total += $p->price * $p->qty;

                                                $rating = \App\Model\MenuReview::where('u_id', auth()->user()->id)
                                                    ->where('menu_id', $p->menu->id)
                                                    ->first();
                                            @endphp
                                            <tr>
                                                <th>PRODUCT</th>
                                                <td style="padding-left: 20px; ">
                                                    <div class="product-cart">
                                                        <img src="{{ url('storage/media/thumb/' . $p->menu->media->media) }}"
                                                            alt="" style="max-height: 100px; border-radius: 8px;">
                                                    </div>
                                                    <div class="product-cart-title">
                                                        <span>{{ $p->menu->name }}</span>
                                                    </div>
                                                </td>
                                                <th>PRICE</th>
                                                <td class="text-center">
                                                    <strong>₹ {{ $p->price }}</strong>
                                                </td>
                                                <th>QUANTITY</th>
                                                <td class="text-center">
                                                    {{ $p->qty }}
                                                </td>
                                                <th>JAIN FOOD</th>
                                                <td class="text-center">
                                                    {{ $p->jain_food }}
                                                </td>
                                                <th>TOTAL</th>
                                                <td class="text-center">
                                                    ₹ {{ $p->price * $p->qty }}
                                                </td>
                                                @if ($order->status == 'Delivered')
                                                    <th>RATE</th>
                                                    <td class="text-center">
                                                        @if (!empty($rating->id))
                                                            @for ($star = 1; $star <= $rating->rating; $star++)
                                                                <i class="icon-star yellow_bg"></i>
                                                            @endfor
                                                            @for ($star = $rating->rating + 1; $star <= 5; $star++)
                                                                <i class="icon-star"></i>
                                                            @endfor
                                                        @else
                                                            <button class="btn btn-xs btn-primary rate_menu_btn"
                                                                data-id="{{ $p->menu->id }}">Rate Menu</button>
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel">
                        <div class="panel-body">
                            <div class="cart-total wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms"
                                style="float: left; border-radius: 4px; margin: 0; padding: 0px; max-width: 100%;">
                                <div class="product-cart-total">
                                    <small style="font-size: 16px;">Total</small>
                                    <span>₹{{ $total }}</span>
                                </div>
                                <div class="product-cart-total">
                                    <small style="font-size: 16px;">Shipping</small>
                                    <span>{{ $order->shipping_charge ? '₹' . $order->shipping_charge : 'Free' }}</span>
                                </div>
                                @if (!empty($order->discount))
                                    <div class="product-cart-total">
                                        <small style="font-size: 16px;">Discount</small>
                                        <span>{{ $order->discount ? '₹' . $order->discount : 'Free' }}</span>
                                    </div>
                                @endif
                                @php
                                    if (!empty($order->shipping_charge)) {
                                        $total += $order->shipping_charge;
                                    }
                                    if (!empty($order->discount)) {
                                        $total -= $order->discount;
                                    }
                                @endphp
                                <div class="grand-total" style="margin: 19px 0 19px;">
                                    <h5>Grand Total <span>₹{{ $total }}</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="panel mb-5">
                                <div class="panel-body">
                                    <h3>Billing Information</h3>
                                    <div class="row mb-5">
                                        <div class="col-xs-4">
                                            <strong>Name</strong>
                                        </div>
                                        <div class="col-xs-8">
                                            {{ $order->billing_fname . ' ' . $order->billing_lname }}
                                        </div>
                                    </div>
                                    @if (!empty($order->billing_company_name))
                                        <div class="row mb-5">
                                            <div class="col-xs-4">
                                                <strong>Company Name</strong>
                                            </div>
                                            <div class="col-xs-8">
                                                {{ $order->billing_company_name }}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row mb-5">
                                        <div class="col-xs-4">
                                            <strong>Email ID</strong>
                                        </div>
                                        <div class="col-xs-8">
                                            {{ $order->billing_email }}
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-xs-4">
                                            <strong>Mobile No.</strong>
                                        </div>
                                        <div class="col-xs-8">
                                            {{ $order->billing_phone }}
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-xs-4">
                                            <strong>Address</strong>
                                        </div>
                                        <div class="col-xs-8">
                                            {{ $billing_addr = $order->address->house_no . ' ' . $order->address->landmark . ' ' . $order->address->address }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="panel">
                                <div class="panel-body">
                                    <h3>Shipping Information</h3>
                                    <div class="row mb-5">
                                        <div class="col-xs-4">
                                            <strong>Name</strong>
                                        </div>
                                        <div class="col-xs-8">
                                            {{ $order->billing_fname . ' ' . $order->billing_lname }}
                                        </div>
                                    </div>
                                    @if (!empty($order->billing_company_name))
                                        <div class="row mb-5">
                                            <div class="col-xs-4">
                                                <strong>Company Name</strong>
                                            </div>
                                            <div class="col-xs-8">
                                                {{ $order->billing_company_name }}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row mb-5">
                                        <div class="col-xs-4">
                                            <strong>Email ID</strong>
                                        </div>
                                        <div class="col-xs-8">
                                            {{ $order->billing_email }}
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-xs-4">
                                            <strong>Mobile No.</strong>
                                        </div>
                                        <div class="col-xs-8">
                                            {{ $order->billing_phone }}
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-xs-4">
                                            <strong>Address</strong>
                                        </div>
                                        <div class="col-xs-8">
                                            {{ $billing_addr }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Rate Modal -->
            <div id="reviewModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Rate &amp; Review</h4>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('save_rating') }}" method="POST" id="productRatingForm">
                                @csrf
                                <input type="hidden" name="rate[menu_id]" id="review_pid" value="">
                                <div class="rating-star">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label for="rating_{{ $i }}"><i class="icon-star"></i> </label>
                                        <input type="radio" name="rate[rating]" value="{{ $i }}"
                                            id="rating_{{ $i }}"
                                            @if ($i == 1) checked @endif>
                                    @endfor
                                </div>
                                <div class="form-group">
                                    <label for="review">Review</label>
                                    <textarea name="rate[review]" id="review" placeholder="Write review here" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
