@extends('frontend.layout.master')

@section('title', 'Edit Profile')

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
                        <a><span>Edit Profile</span></a>
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
                                    <a href="{{ route('profile') }}" class="pull-right" title="Edit"
                                        data-toggle="tooltip"><i class="icon-user" style="background: none"></i> View
                                        Profile</a>
                                    <h3>Edit Profile</h3>
                                    <form method="POST" action="{{ route('profile.update') }}">
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
                                                <label for="fname">First Name *</label>
                                                <input type="text" name="record[fname]"
                                                    value="{{ old('record.fname', $user->fname) }}" class=""
                                                    placeholder="First Name" required id="fname">
                                            </div>
                                            <div class="col-xs-6">
                                                <label for="lname">Last Name</label>
                                                <input type="text" name="record[lname]"
                                                    value="{{ old('record.lname', $user->lname) }}" class=""
                                                    placeholder="Last Name" id="lname">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="name">Display Name *</label>
                                                <input type="text" name="record[name]"
                                                    value="{{ old('record.name', $user->name) }}" class=""
                                                    placeholder="Name" required id="name" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="email">Email ID *</label>
                                                <input type="email" name="record[email]"
                                                    value="{{ old('record.email', $user->email) }}" class=""
                                                    placeholder="Email ID" required id="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn-main">Update</button>
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
