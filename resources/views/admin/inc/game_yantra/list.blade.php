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
                    <form method="POST" action="{{ url(env('ADMIN_DIR') . '/blog/list') }}">
                        @csrf
                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-xs-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                                        <h6 class="m-0 font-weight-bold text-primary">Blog List</h6>
                                        <div class="">
                                            <a href="{{ url(env('ADMIN_DIR') . '/blog/add') }}"
                                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">+ Add
                                                Blog</a>
                                            <button type="submit"
                                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                                                data-url="{{ url(env('ADMIN_DIR') . '/blog/delete/all') }}"
                                                id="delete_all">Delete</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>S No.</th>
                                                    <th>Title</th>
                                                    <th>Image</th>
                                                    <th>Description</th>
                                                    <th>Category</th>
                                                    <th>Tags</th>
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
                                                        <td>
                                                            <a
                                                                href="{{ url(env('ADMIN_DIR') . '/blog/edit/' . $list->id) }}">
                                                                <i class="far fa-edit" aria-hidden="true"></i>
                                                                {{ $list->title }}
                                                            </a>
                                                        </td>
                                                        <td>
                                                            @if ($list->media)
                                                                <img src="{{ url('storage/media/' . $list->media->media) }}"
                                                                    alt="" width="100">
                                                            @else
                                                                NO IMAGE
                                                            @endif
                                                        </td>
                                                        <td>{{ $list->excerpt }}</td>
                                                        <td>{{ !empty($list->blogcategory->name) ? $list->blogcategory->name : 'N/A' }}
                                                        </td>
                                                        <td>{{ $list->tags }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $lists->links() }}
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
