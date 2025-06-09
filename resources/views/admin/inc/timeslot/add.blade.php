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
                                    <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
                                    <button class="btn btn-primary" data-toggle="collapse" data-target="#category_box">+
                                        Add</button>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body collapse" id="category_box">
                                    <form method="POST" action="">
                                        @csrf
                                        @include('admin.inc.blog-category._form')
                                        <div class="text-right">
                                            <input type="submit" class="btn btn-primary" name="login"
                                                value="Add Category" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-lg-12">
                            <form method="POST" action="{{ url(env('ADMIN_DIR') . '/blog-category/delete/all') }}">
                                @csrf
                                <div class="card">
                                    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                                        <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                                        <button type="submit"
                                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                            data-url="{{ url(env('ADMIN_DIR') . '/blog-category/delete/all') }}"
                                            id="delete_all">Delete</button>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>S No.</th>
                                                    <th>Category Name</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $sn = $lists->firstItem();
                                                @endphp
                                                @foreach ($lists as $list)
                                                    <tr class="bg-light">
                                                        <td>{{ $sn++ }}.
                                                            @if (!$list->blog_count)
                                                                | <input type="checkbox" name="sub_chk[]"
                                                                    value="{{ $list->id }}" class="sub_chk"
                                                                    data-id="{{ $list->id }}">
                                                            @else
                                                                | It is in use.
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="{{ route('admin_blog-category_edit', $list->slug) }}">
                                                                <i class="far fa-edit" aria-hidden="true"></i>
                                                                {{ $list->name }}
                                                            </a>
                                                        </td>
                                                        <!-- <td>
                                   <a href="{{ url(env('ADMIN_DIR') . '/tag/delete', $list->id) }}" class="btn btn-danger btn-sm"
                                  data-tr="tr_{{ $list->id }}"
                                  data-toggle="confirmation"
                                  data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                                  data-btn-ok-class="btn btn-sm btn-danger"
                                  data-btn-cancel-label="Cancel"
                                  data-btn-cancel-icon="fa fa-chevron-circle-left"
                                  data-btn-cancel-class="btn btn-sm btn-default"
                                  data-title="Are you sure you want to delete ?"
                                  data-placement="left" data-singleton="true">
                                   Delete</a>
                                 </td> -->
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
