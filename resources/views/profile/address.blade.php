@extends('frontend.layout.master')

@section('title', 'My Address')

@section('contant')
<div>
    <div class="mapview d-none" style="widht:400px; display: none; position: absolute; top: 0px; left: 0px; z-index: 999; position: fixed;" display="none">
        <div style="width: 400px; height: 100vh; background-color: white; padding: 0px 25px 25px 25px; overflow-x: auto;">
            @include('frontend.inc.sideview')
        </div>
    </div>
</div>
<main>
    <div class="main-part">
        <!-- Start Breadcrumb Part -->
        <section class="breadcrumb-part menu-part" data-stellar-offset-parent="true" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('imgs/breadbg1.jpg') }}');">
            <div class="container">
                <div class="breadcrumb-inner">
                    <h2>My Address</h2>
					<a href="{{ url('/') }}">Home</a>
                    <a href="{{ route('profile') }}">Profile</a>
                    <a><span>My Address</span></a>
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
							    <!--<h6 class="text-right" style="margin-bottom: 0;"><span id="map-address" style="cursor:pointer;">Add Address</span></h6>-->
								<a class="pull-right" id="map-address" style="cursor:pointer;" title="Edit" data-toggle="tooltip"><i class="icon-map-marker" style="background: none"></i> Add Address</a>
								<h3>My Address</h3>
								@foreach($address as $list)
								<div class="panel" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
								    <div class="panel-body">
                                        <div class="checkout-log" style="margin: 0;">
                                            <div class="row">
                                                <div class="col-xs-1 col-md-1 checkout-log-add">
                                                    <div style="padding: 0 15px;">
                                                        @if($list->type == 'Home')
                                                        <i class="fa fa-home"></i>
                                                        @endif
                                                        @if($list->type == 'Work')
                                                        <i class="fa fa-briefcase"></i>
                                                        @endif
                                                        @if($list->type == 'Other')
                                                        <i class="fa fa-map-marker"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xs-10 col-md-9 checkout-log-add" style="padding: 10px 10px;">
                                                    <div><b>{{ $list->type }}</b></div>
                                                    <div>{{ $list->house_no }}, {{ $list->landmark }}, {{ $list->address }}</div>
                                                </div>
                                                <div class="col-xs-1 col-md-1 checkout-log-add">
                                                    <div style="padding: 0 15px; padding-left: 40px;">
                                                        <a href="{{ url('account/delete_address/'.$list->id) }}" style="color:red;"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                                <!--<div class="col-xs-12 col-md-6 checkout-log-add text-center">-->
                                                <!--    <a href="{{ url('account/edit_address/'.$list->id) }}"><div class="form-control alert-success">Edit Address</div></a>-->
                                                <!--</div>-->
                                                <!--<div class="col-xs-12 col-md-6 checkout-log-add text-center">-->
                                                <!--    <a href="{{ url('account/delete_address/'.$list->id) }}"><div class="form-control alert-danger">Delete Address</div></a>-->
                                                <!--</div>-->
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
            </div>
        </section>
    </div>
</main>
@stop
