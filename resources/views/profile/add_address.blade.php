@extends('frontend.layout.master')

@section('title', 'Add Address')

@section('contant')

    <main>
        <div class="main-part">
            <!-- Start Breadcrumb Part -->
            <section class="breadcrumb-part menu-part" data-stellar-offset-parent="true" data-stellar-background-ratio="0.5"
                style="background-image: url('{{ url('imgs/breadbg1.jpg') }}');">
                <div class="container">
                    <div class="breadcrumb-inner">
                        <h2>Profile</h2>
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ route('profile') }}">Profile</a>
                        <a><span>Add Address</span></a>
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
                                    <a href="{{ route('address') }}" class="pull-right" title="Edit"
                                        data-toggle="tooltip"><i class="icon-map-marker" style="background: none"></i> View
                                        Address</a>
                                    <h3>Add Address</h3>
                                    <form method="POST" action="{{ route('address.store') }}">
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
                                            <div class="col-xs-6">
                                                <label for="country">Country Name</label>
                                                <input type="text" name="country" id="country" class=""
                                                    placeholder="Country Name" required value="{{ old('country') }}">
                                            </div>
                                            <div class="col-xs-6">
                                                <label for="state">State Name</label>
                                                <select name="state" id="state" class="select-dropbox" required>
                                                    <option value="0">Select State</option>
                                                    @foreach ($states as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ old('state') == $key ? 'selected' : '' }}>
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label for="city">City Name</label>
                                                <select name="city" id="city" class="select-dropbox" required>
                                                    <option value="0">Select City</option>
                                                    @foreach ($cities as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ old('city') == $key ? 'selected' : '' }}>
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-xs-6">
                                                <label for="pincode">Pincode</label>
                                                <input type="number" name="pincode" id="pincode" class=""
                                                    placeholder="Pincode" required value="{{ old('pincode') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" id="address" class=""
                                                    placeholder="Address" required value="{{ old('address') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn-main">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@stop
