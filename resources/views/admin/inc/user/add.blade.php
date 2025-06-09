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
                                    <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
                                    <a href="{{ url('admin/user') }}"
                                        class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i
                                            class="fas fa-download fa-sm text-white-50"></i> View User</a>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body" id="category_box">
                                    <form method="POST" action="{{ route('user.store') }}" class="user">
                                        @csrf
                                        @include('admin.inc.user._form')
                                        <div class="text-right">
                                            <input type="submit" class="btn btn-primary" value="Add User" />
                                        </div>
                                    </form>
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
