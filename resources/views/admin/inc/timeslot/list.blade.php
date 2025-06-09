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
                    @if (\Session::has('success'))
                        <div class="alert alert-success toast-msg" style="color: green">
                            {!! \Session::get('success') !!}</li>
                        </div>
                    @endif
                    <div class="card-body bg-white mb-3" id="category_box">
                        <form method="POST" action="{{ route('timeslot.store') }}" class="user">
                            @csrf
                            @include('admin.inc.timeslot._form')
                            <div class="text-right">
                                <input type="submit" class="btn btn-primary mb-3" value="Create Timeslot" />
                            </div>
                        </form>
                    </div>
                    @php
                        $statusArr = [
                            'low' => 'Low',
                            'medium' => 'Medium',
                            'high' => 'High',
                        ];
                        $typeArr = [
                            '' => 'Select Type',
                            'yantra' => 'Yantra',
                            'city' => 'City',
                        ];

                        $OStatus = [
                            '' => 'Select auto win',
                            '0' => 'On',
                            '1' => 'Off',
                        ];

                        $switchTpye = [
                            'all' => 'All',
                            'custom' => 'Custom',
                        ];
                    @endphp

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-xs-12 col-lg-12">
                            <div class="card">
                                <div class="card-header align-items-center justify-content-between mb-4">
                                    <div class="row">
                                        <div class="col-lg-8"> </div>
                                        <div class="col-lg-4">
                                            <form method="POST"
                                                action="{{ url('admin\TimeslotController@editstatus') }}"
                                                class="user">
                                                @csrf
                                                <input type="hidden" name="type" value="{{ request('g_type') }}">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <select name="status" class="form-control" id="Editstatus">
                                                            @foreach ($statusArr as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input type="submit" class="btn btn-primary mb-3 form-control"
                                                            value="Change" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <form method="POST" action="{{ url('admin\TimeslotController@editswitch') }}"
                                    class="user" id="editSwitchForm">
                                    @csrf
                                    <div style="width: 40%; position:absolute; left: 30px; top: 15px;">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <select name="switchtype" class="form-control" id="switchType">
                                                    @foreach ($switchTpye as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <select name="switch" class="form-control" id="Editswitch">
                                                    @foreach ($OStatus as $key => $value)
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <input type="submit" id="changeselectStatus" data-url="jd"
                                                    class="btn btn-primary mb-3 btn-block" value="Update" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>S No.</th>
                                                    <th>Timeslot</th>
                                                    <th>Type</th>
                                                    <th>Status</th>
                                                    <th>Auto win</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($lists as $key => $list)
                                                    <tr class="bg-light">
                                                        <td>{{ $key + 1 }}.
                                                            | <input type="checkbox" name="sub_chk[]"
                                                                value="{{ $list->id }}" class="sub_chk"
                                                                data-id="{{ $list->id }}">
                                                        </td>
                                                        <td>{{ $list->time }}</td>
                                                        <td>{{ $list->type }}</td>
                                                        <td>{{ $list->status }}</td>
                                                        <td>
                                                            @if ($list->is_switch == '0')
                                                                <a href="{{ route('change_status', [$list->id, 'field' => 'is_switch', 'is_switch' => '1', 'id' => $list->id]) }}"
                                                                    class="btn btn-success text-white"
                                                                    style="color:#fff;">On </a>
                                                            @else
                                                                <a href="{{ route('change_status', [$list->id, 'field' => 'is_switch', 'is_switch' => '0', 'id' => $list->id]) }}"
                                                                    class="btn btn-danger text-white"
                                                                    style="color:#fff;">Off</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
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
        function selectAll() {
            var ele = document.getElementsByName('sub_chk[]');
            for (var i = 0; i < ele.length; i++) {
                if (ele[i].type == 'checkbox')
                    ele[i].checked = true;
            }
        }

        function deSelect() {
            var ele = document.getElementsByName('chk');
            for (var i = 0; i < ele.length; i++) {
                if (ele[i].type == 'checkbox')
                    ele[i].checked = false;
            }
        }

        function cityChangedTrigger() {
            let queryString = "{{ url('admin/timeslot/') }}";
            document.location = queryString + "?p=" + document.getElementById("p").value;
        }
    </script>
