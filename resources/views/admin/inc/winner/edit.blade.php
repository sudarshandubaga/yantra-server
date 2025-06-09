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
                                    <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
                                    <a href="{{ url('admin/wallet') }}"
                                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                            class="fas fa-download fa-sm text-white-50"></i> View Testimonial</a>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body">
                                    <form method="POST" action="{{ route('wallet.update', $edit['id']) }}"
                                        class="user">
                                        @csrf
                                        @method('PUT')
                                        @include('admin.inc.winner._form')
                                        <div class="text-right">
                                            <input type="submit" class="btn btn-primary" value="Edit Yantra" />
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
