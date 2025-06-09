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

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Add Blog</h6>
                                    <a href="{{ url('restaurent-control/blog/list') }}"
                                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                            class="fas fa-download fa-sm text-white-50"></i> View Blog</a>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data" class="user">
                                        @csrf
                                        @include('admin.inc.blog._form')
                                        <div class="text-right">
                                            <input type="submit" class="btn btn-primary" name="edit_category"
                                                value="Edit" />
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
    <!-- End of Page Wrapper -->
