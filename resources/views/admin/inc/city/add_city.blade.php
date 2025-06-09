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
                            {!! \Session::get('success') !!}
                        </div>
                    @endif

                    @if (\Session::has('danger'))
                        <div class="alert alert-danger toast-msg" style="color: red;">
                            {!! \Session::get('danger') !!}
                        </div>
                    @endif
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Add City</h6>
                                    <button class="btn btn-primary" data-toggle="collapse" data-target="#city_box">+
                                        Add</button>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body collapse" id="city_box">
                                    <form action="{{ url(env('ADMIN_DIR') . '/city/add') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @include('admin.template._city_form')
                                        <div class="text-right">
                                            <input type="submit" class="btn btn-primary" name="login"
                                                value="Add City" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-lg-12">
                            <form action="{{ url(env('ADMIN_DIR') . '/add-city/delete/all') }}" method="POST">
                                @csrf
                                <div class="card">
                                    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                                        <h6 class="m-0 font-weight-bold text-primary">City List</h6>
                                        <button type="submit"
                                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                            data-url="{{ url(env('ADMIN_DIR') . '/add-city/delete/all') }}"
                                            id="delete_all">Delete</button>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>S No.</th>
                                                    <th>City Name</th>
                                                    <th>State Name</th>
                                                    <th>City Slug</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $sn = $lists->firstItem();
                                                @endphp
                                                @foreach ($lists as $list)
                                                    <tr class="bg-light">
                                                        <td>{{ $sn++ }}. |
                                                            <input type="checkbox" name="sub_chk[]"
                                                                value="{{ $list->id }}" class="sub_chk"
                                                                data-id="{{ $list->id }}">
                                                        </td>
                                                        <td><a
                                                                href="{{ url(env('ADMIN_DIR') . '/city/edit/' . $list->id) }}"><i
                                                                    class="far fa-edit" aria-hidden="true"></i>
                                                                {{ $list->name }}</a></td>
                                                        <td>{{ $list->state->name }}</td>
                                                        <td>{{ $list->slug }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        {{ $lists->links() }}
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
