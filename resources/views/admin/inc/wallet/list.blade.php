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
                    <form action="{{ url(env('ADMIN_DIR') . '/wallet') }}" method="POST">
                        @csrf
                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-xs-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
                                        <h6 class="m-0 font-weight-bold text-primary">Wallet List</h6>
                                        <div class="">
                                            <a href="{{ url(env('ADMIN_DIR') . '/wallet/create') }}"
                                                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">+ Add
                                                Credit/Debit</a>
                                            <!-- <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"  data-url="{{ url(env('ADMIN_DIR') . '/wallet/delete') }}" id="delete_all">Delete</button> -->
                                        </div>
                                    </div>
                                    <form method="GET" action="">
                                        <div class="row mx-2" style="margin-bottom: -24px;">
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    @php
                                                        $user = App\Models\User::get();
                                                        $userArr = [
                                                            '' => 'Select User',
                                                        ];
                                                        foreach ($user as $c) {
                                                            $userArr[$c->id] = $c->name;
                                                        }
                                                    @endphp
                                                    <select name="user_id" class="form-control mb-5" id="name"
                                                        onchange="cityChangedTrigger ()">
                                                        @foreach ($userArr as $id => $name)
                                                            <option value="{{ $id }}"
                                                                {{ request('user_id') == $id ? 'selected' : '' }}>
                                                                {{ $name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($request->user_id)
                                    </form>
                                    <div class="card-body mt-0 ">
                                        <table class="table table-bordered">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>S No.</th>
                                                    <th>Remarks</th>
                                                    <th>Credit</th>
                                                    <th>Debit</th>
                                                    <th>Balance</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $balance = 0;
                                                @endphp
                                                @foreach ($lists as $key => $list)
                                                    @php
                                                        if ($list->type == 'credit') {
                                                            $balance += $list->amount;
                                                        } else {
                                                            $balance -= $list->amount;
                                                        }
                                                    @endphp
                                                    <tr class="bg-light">
                                                        <td>{{ $key + 1 }}.
                                                            <!-- <input type="checkbox" name="sub_chk[]" value="{{ $list->id }}" class="sub_chk" data-id="{{ $list->id }}"> -->
                                                        </td>
                                                        <td>
                                                            {{ $list->remarks }}

                                                        </td>
                                                        <td>
                                                            @if ($list->type == 'credit')
                                                                {{ $list->amount }}
                                                            @else
                                                                0
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($list->type == 'debit')
                                                                {{ $list->amount }}
                                                            @else
                                                                0
                                                            @endif
                                                        </td>
                                                        <td>{{ $balance }}</td>
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
                                                <tr>
                                                    <th>Total</th>
                                                    <th></th>
                                                    <th>{{ $totalCredits }}</th>
                                                    <th>{{ $totalDebits }}</th>
                                                    <th>{{ $balance }}</th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    @endif
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <script>
        function cityChangedTrigger() {
            let queryString = "{{ url('admin/wallet/') }}"; // get url parameters  
            document.location = queryString + "?user_id=" + document.getElementById("name")
                .value; // refresh the page with new url
        }
    </script>
    <script>
        $(document).ready(function() {
            $("select").select2();
        });
    </script>
