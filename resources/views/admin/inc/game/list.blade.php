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
                    <form action="{{ url(env('ADMIN_DIR') . '/game/') }}" method="POST">
                        @csrf
                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-xs-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                                        <h6 class="m-0 font-weight-bold text-primary">Game List</h6>
                                        <div class="">
                                            <!-- <a href="{{ url(env('ADMIN_DIR') . '/game/') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">+ Add Game</a> -->
                                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                                data-url="{{ url(env('ADMIN_DIR') . '/game/delete') }}"
                                                id="delete_all">Delete</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>S No.</th>
                                                    <th>Name</th>
                                                    <th>Image</th>
                                                    <th>Type</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($lists as $key => $list)
                                                    <tr class="bg-light">
                                                        <td>{{ $key + 1 }}. |
                                                            <input type="checkbox" name="sub_chk[]"
                                                                value="{{ $list->id }}" class="sub_chk"
                                                                data-id="{{ $list->id }}">
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="{{ url('admin/game/' . $list->id . '/edit?type=' . $list->type) }}">
                                                                <i class="far fa-edit" aria-hidden="true"></i>
                                                                {{ $list->name }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <img src="{{ url('imgs/game/' . $list->image) }}"
                                                                alt="" width="50">
                                                        </td>
                                                        <td>{{ $list->type }}</td>
                                                    </tr>
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
