@extends('frontend.layout.master')

@section('title', 'Change Password')

@section('contant')

    <main>
        <div class="main-part">
            <!-- Start Breadcrumb Part -->
            <section class="breadcrumb-part menu-part" data-stellar-offset-parent="true" data-stellar-background-ratio="0.5"
                style="background-image: url('{{ url('imgs/breadbg1.jpg') }}');">
                <div class="container">
                    <div class="breadcrumb-inner">
                        <h2>Change Password</h2>
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ route('profile') }}">Profile</a>
                        <a><span>Change Password</span></a>
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
                                <div class="panel-body" style="min-height: 380px">
                                    <h3 class="mb-15">Change Password</h3>
                                    <form method="POST" action="{{ route('your.change.password.route') }}">
                                        @csrf
                                        @if (\Session::has('success'))
                                            <div class="alert alert-success toast-msg" style="color: green">
                                                {!! \Session::get('success') !!}
                                            </div>
                                        @endif
                                        @if (\Session::has('danger'))
                                            <div class="alert alert-danger toast-msg" style="color: red;">
                                                {!! \Session::get('danger') !!}
                                            </div>
                                        @endif
                                        @if ($message = Session::get('error'))
                                            <div class="alert alert-danger alert-block">
                                                <button type="button" class="close" data-dismiss="alert">x</button>
                                                {{ $message }}
                                            </div>
                                        @endif
                                        @if (count($errors->all()))
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="current_password">Current Password</label>
                                                <input type="password" name="current_password" id="current_password"
                                                    placeholder="Current Password" required autocomplete="new-password">
                                            </div>
                                            <div class="col-xs-12">
                                                <label for="new_password">New Password</label>
                                                <input type="password" name="new_password" id="new_password"
                                                    placeholder="New Password" required autocomplete="new-password">
                                            </div>
                                            <div class="col-xs-12">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" name="confirm_password" id="confirm_password"
                                                    placeholder="Confirm Password" required autocomplete="new-password">
                                            </div>
                                            <div class="col-xs-12">
                                                <button type="submit" class="btn-main">Change Password</button>
                                            </div>
                                        </div>
                                    </form>
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
                            <form method="POST" action="{{ route('save_rating') }}" id="productRatingForm">
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
