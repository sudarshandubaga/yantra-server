@extends('frontend.layout.master')

@section('title', 'Profile')

@section('contant')

		<main>
    <div class="main-part">
        <!-- Start Breadcrumb Part -->
        <section class="breadcrumb-part menu-part" data-stellar-offset-parent="true" data-stellar-background-ratio="0.5" style="background-image: url('{{ url('imgs/breadbg1.jpg') }}');">
            <div class="container">
                <div class="breadcrumb-inner">
                    <h2>Profile</h2>
                    <a href="{{ url('/') }}">Home</a>
                    <a><span>Profile</span></a>
                </div>
            </div>
        </section>
        <!-- End Breadcrumb Part -->
        <section class="home-icon login-register bg-skeen">
            <div class="icon-default icon-skeen">
                <img src="{{url('imgs/scroll-arrow.png')}}" alt="">
            </div>
            <div class="container">
                <div class="row">
                    @include('profile.sidebar')
                    <div class="col-sm-8">
						<div class="panel">
							<div class="panel-body">
								<a href="{{ route('edit_profile') }}" class="pull-right" title="Edit" data-toggle="tooltip"><i class="icon-pencil"></i> Edit</a>
								<h3>Personal Information</h3>
								<div class="row mb-5">
									<div class="col-xs-4">
										<strong>First Name</strong>
									</div>
									<div class="col-xs-8">
										{{ auth()->user()->fname }}
									</div>
								</div>
								<div class="row mb-5">
									<div class="col-xs-4">
										<strong>Last Name</strong>
									</div>
									<div class="col-xs-8">
										{{ auth()->user()->lname }}
									</div>
								</div>
								<div class="row mb-5">
									<div class="col-xs-4">
										<strong>Display Name</strong>
									</div>
									<div class="col-xs-8">
										{{ auth()->user()->name }}
									</div>
								</div>
								<div class="row mb-5">
									<div class="col-xs-4">
										<strong>Email ID</strong>
									</div>
									<div class="col-xs-8">
										{{ auth()->user()->email }}
									</div>
								</div>
								<div class="row mb-5">
									<div class="col-xs-4">
										<strong>Mobile No.</strong>
									</div>
									<div class="col-xs-8">
										{{ auth()->user()->mobile }}
									</div>
								</div>
							</div>
						</div>
                    </div>
                    @if(auth()->user()->referal_code != '')
                    <div class="col-sm-8">
						<div class="panel">
							<div class="panel-body text-center">
								<div style="margin: auto; margin-top: 10px; margin-bottom: 15px;">
									<b style="padding: 10px; border-radius: 8px; box-shadow: 0 1px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">Refer Code is "<span style="color: black;">{{ auth()->user()->referal_code }}</span>"</b>
								</div>
								<h5 style="margin-top: 10px;">Refer Friends. Get Points.</h5>
								<p><a href="">Share Invite Code <i class="fa fa-share"></i></a> </p>
							</div>
						</div>
                    </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
</main>
@stop
