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
                    <form action="{{ url(env('ADMIN_DIR') . '/') }}" method="POST">
                        @csrf
                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-xs-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                                        <h6 class="m-0 font-weight-bold text-primary">Place point List</h6>
                                        <div class="">
                                            <!-- <a href="{{ url(env('ADMIN_DIR') . '/wallet/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">+ Add</a> -->
                                            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                                data-url="{{ url(env('ADMIN_DIR') . '/placepoint/delete') }}"
                                                id="delete_all">Delete</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered" id="dataTable" width="100%"
                                            cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>S No.</th>
                                                    <th>User Name</th>
                                                    <th>Game</th>
                                                    <th>Game Image</th>
                                                    <th>Point</th>
                                                    <th>Remarks</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($lists as $key => $list)
                                                    <tr class="bg-light">
                                                        <td>{{ $key + 1 }} .
                                                            <!-- | <input type="checkbox" name="sub_chk[]" value="{{ $list->id }}" class="sub_chk" data-id="{{ $list->id }}"> -->
                                                        </td>
                                                        <td>
                                                            {{ $list->user->name ? $list->user->name : '' }}
                                                        </td>
                                                        <td>{{ $list->game->name ? $list->game->name : '' }}</td>
                                                        <td>
                                                            <img src="{{ url('imgs/game/' . $list->game->image) }}"
                                                                alt="" width="50">
                                                        </td>
                                                        <td>{{ $list->point }}</td>
                                                        <td>{{ $list->remarks }}</td>
                                                        <!-- <td>
                              <a href="{{ url(env('ADMIN_DIR') . '/testimonial/delete', $list->id) }}"  class="btn btn-danger btn-sm"
                                data-tr="tr_{{ $list->id }}"
                                data-toggle="confirmation"
                                data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                                data-btn-ok-class="btn btn-sm btn-danger"
                                data-btn-cancel-label="Cancel"
                                data-btn-cancel-icon="fa fa-chevron-circle-left"
                                data-btn-cancel-class="btn btn-sm btn-default"
                                data-title="Are you sure you want to delete ?"
                                data-placement="left" data-singleton="true"
                                onclick="return confirm('Are you sure you want to delete this item?');">
                                Delete</a>
                            </td> -->
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
