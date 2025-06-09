<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('admin.common.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                @include('admin.common.TopHeader')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    @if (\Session::has('success'))
                        <div class="alert alert-success toast-msg" style="color: green">
                            {!! \Session::get('success') !!}</li>
                        </div>
                    @endif

                    @if (\Session::has('danger'))
                        <div class="alert alert-danger toast-msg" style="color: red;">
                            {!! \Session::get('danger') !!}</li>
                        </div>
                    @endif
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Add Winner</h6>
                                    <!-- <a href="{{ url('admin/winner') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> View Winner</a> -->
                                </div>

                                <!-- Card Body -->
                                <div class="card-body" id="category_box">
                                    <form method="GET">
                                        <div class="row mb-5">
                                            <div class="col-lg-3">
                                                @php $abc = request('date') ?? date('Y-m-d'); @endphp
                                                <div class="form-group">
                                                    <input type="date" name="date" class="form-control"
                                                        id="datepicker" value="{{ $abc }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="time" name="start_time" class="form-control"
                                                                value="{{ request('start_time') }}"
                                                                placeholder="Start Time">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input type="time" name="end_time" class="form-control"
                                                                value="{{ request('end_time') }}"
                                                                placeholder="End Time">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    @php
                                                        $typeArr = [
                                                            'yantra' => 'Yantra',
                                                            'city' => 'City',
                                                        ];
                                                    @endphp
                                                    <select name="type" class="form-control" id="type">
                                                        <option value="">Select Type</option>
                                                        @foreach ($typeArr as $key => $value)
                                                            <option value="{{ $key }}"
                                                                {{ request('type') == $key ? 'selected' : '' }}>
                                                                {{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-lg-1">
                                                <button type="submit" class="btn btn-dark form-control">Go</button>
                                            </div>

                                        </div>
                                    </form>

                                    @if (!empty(request('date')) && !empty(request('type')))
                                        <form method="POST" action="{{ route('winner.store') }}" class="user">
                                            @csrf
                                            <input type="hidden" name="date" value="{{ request('date') }}">
                                            <input type="hidden" name="type" value="{{ request('type') }}">
                                            @include('admin.inc.winner._form')
                                            <div class="text-right"
                                                style="position: fixed; left:90%;right:1%;bottom:8%;">
                                                <input type="submit" class="btn btn-primary" value="Save Change " />
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("date")[0].setAttribute('min', today);
    </script>
