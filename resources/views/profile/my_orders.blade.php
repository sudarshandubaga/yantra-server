@extends('frontend.layout.master')

@section('title', 'My Orders')

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
                    <a><span>My Orders</span></a>
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
						<div class="panel">
							<div class="panel-body">
								<h3>My Orders</h3>
								@foreach($lists as $i => $list)
								<div class="panel" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
								    <div class="panel-body">
								        <div class="row">
								            <div class="col-md-6 col-sm-6 col-xs-12">
								                <div class="row">
								                    <div class="col-md-6 col-sm-4 col-xs-6">
								                        <strong>Invoice No.</strong>
								                    </div>
								                    <div class="col-md-6 col-sm-4 col-xs-6">
								                        {{ sprintf("%s/%s/%04d", $setting->invoice_prefix, $list->financial_year, $list->invoice_no) }}
								                    </div>
								                </div>
								            </div>
								            
								            <div class="col-md-6 col-sm-6 col-xs-12">
								                <div class="row">
								                    <div class="col-md-6 col-sm-4 col-xs-6">
								                        <strong>Date</strong>
								                    </div>
								                    <div class="col-md-6 col-sm-4 col-xs-6">
								                        {{ $list->created_at->format('M d, Y') }}
								                    </div>
								                </div>
								            </div>
								        </div>
								        <div class="row">
								            <div class="col-md-6 col-sm-6 col-xs-12">
								                <div class="row">
								                    <div class="col-md-6 col-sm-4 col-xs-6">
								                        <strong>Amount</strong>
								                    </div>
								                    <div class="col-md-6 col-sm-4 col-xs-6">
								                        ₹{{ $list->total_amount }}
								                    </div>
								                </div>
								            </div>
								        </div>
								        <div class="row">
								            <div class="col-md-6 col-sm-6 col-xs-12">
								                <div class="row">
								                    <div class="col-md-6 col-sm-4 col-xs-6">
								                        <strong>Status</strong>
								                    </div>
								                    <div class="col-md-6 col-sm-4 col-xs-6">
								                        {{ $list->status }}
								                    </div>
								                </div>
								            </div>
								            <div class="col-md-6 col-sm-6 col-xs-12">
								                <div class="row">
								                    <div class="col-md-6 col-sm-4 col-xs-6">
								                        
								                    </div>
								                    <div class="col-md-6 col-sm-4 col-xs-6 text-right">
								                        <strong><a href="{{ route('order_info', $list->id) }}">view more</a></strong>
								                    </div>
								                </div>
								            </div>
								        </div>
								    </div>
								</div>
								@endforeach
<!--								<div class="table-responsive">-->
<!--									<table class="table table-sm table-striped table-bordered">-->
<!--										<thead>-->
<!--											<tr>-->
<!--												<th>#</th>-->
<!--												<th>Invoice No.</th>-->
<!--												<th>Amount</th>-->
<!--												<th>Date</th>-->
<!--												<th>Status</th>-->
<!--												<th>Details</th>-->
<!--											</tr>-->
<!--										</thead>-->
<!--										<tbody>-->
<!--											@foreach($lists as $i => $list)-->
<!--											<tr>-->
<!--												<td>{{ $sn++ }}.</td>-->
<!--												<td>-->
<!--													<a href="{{ route('order_info', $list->id) }}">{{ sprintf("%s/%s/%04d", $setting->invoice_prefix, $list->financial_year, $list->invoice_no) }}</a>-->
<!--												</td>-->
<!--												<td>{{ $list->total_amount }}</td>-->
<!--												<td>{{ $list->created_at->format('F d, Y h:i A') }}</td>-->
<!--												<td>{{ $list->status }}</td>-->
<!--												<td>-->
<!--													<a href="{{ route('order_info', $list->id) }}" class="btn btn-sm btn-primary">Details <i class="icon-arrow-right2 icomoon"></i></a>-->
<!--												</td>-->
<!--											</tr>-->
<!--											@endforeach-->
<!--										</tbody>-->
<!--									</table>-->
<!--									<div class="col-md-12 col-sm-4 col-xs-6 menu">-->
<!--            					        	@foreach($lists as $i => $list)-->
<!--            			                    <div class="shop-main-list">-->
<!--                                                <div class="row">-->
<!--            										<div class="col-md-4">-->
            											
<!--            										</div>-->
<!--            										<div class="col-md-8">-->

<!--            										</div>-->
<!--            									</div>-->
<!--            			                    </div>-->
<!--            					            @endforeach-->
<!--            							</div>-->
<!--									<div class="panel">-->
<!--            							<div class="panel-body">-->
<!--            					        	@foreach($lists as $i => $list)-->
<!--            			                    <div class="shop-main-list">-->
<!--                                                <div class="row">-->
<!--            										<div class="col-md-4">-->
<!--            											dsf-->
<!--            										</div>-->
<!--            										<div class="col-md-8">-->
<!--dsf-->
<!--            										</div>-->
<!--            									</div>-->
<!--            			                    </div>-->
<!--            					            @endforeach-->
<!--            							</div>-->
<!--            						</div>-->
<!--                                </div>-->
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
@stop
