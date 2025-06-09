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
                    <form method="GET">
                        <div class="row mb-5">
                            <div class="col-lg-6">
                                @php $abc = request('date') ?? date('Y-m-d'); @endphp
                                <div class="form-group">
                                    <input type="date" name="date" class="form-control" id="datepicker"
                                        value="{{ $abc }}">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    @php
                                        $typeArr = [
                                            'yantra' => 'Yantra',
                                            'city' => 'City',
                                        ];
                                        $selectedType = request('type');
                                    @endphp

                                    <select name="type" class="form-control" id="type">
                                        @foreach ($typeArr as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $selectedType == $key ? 'selected' : '' }}>{{ $value }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-lg-1">
                                <button type="submit" class="btn btn-dark form-control">Go</button>
                            </div>

                        </div>
                    </form>
                    <form action="{{ url(env('ADMIN_DIR') . '/win') }}" method="POST">
                        @csrf
                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-xs-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                                        <h6 class="m-0 font-weight-bold text-primary">Point History</h6>
                                        <div class="">
                                            <!-- <a href="{{ url(env('ADMIN_DIR') . '/winner/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">+ Add & Edit Winner</a> -->
                                            <!-- <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  data-url="{{ url(env('ADMIN_DIR') . '/winner/delete') }}" id="delete_all">Delete</button> -->

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>S No.</th>
                                                    <th>Timeslot</th>
                                                    <th>Game Name</th>
                                                    <th>Game Image</th>
                                                    <th>Type</th>
                                                    <th>Point</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($gameArr as $date => $data)
                                                    <tr class="bg-light">
                                                        <td colspan='6'>{{ $date }}</td>

                                                    </tr>
                                                    @foreach ($data as $time => $tdata)
                                                        @foreach ($tdata as $index => $gdata)
                                                            <tr>
                                                                <td>{{ ++$i }}</td>
                                                                @if ($index == 0)
                                                                    <td rowspan='{{ count($tdata) }}'>
                                                                        {{ $time }}</td>
                                                                @endif
                                                                <td>{{ @$gdata['game']->name }}</td>
                                                                <td>
                                                                    <img src="{{ url('imgs/game/' . @$gdata['game']->image) }}"
                                                                        alt="{{ @$gdata['game']->name }}"
                                                                        width="50">
                                                                </td>
                                                                <td>{{ @$gdata['game']->type }}</td>

                                                                <td>{{ @$gdata['point'] }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
