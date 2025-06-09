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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->
          <div class="row">

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total No. of game</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $game }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total no. of city</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $city_game }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total no. of yantra</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $yantra_game }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total No. Of user</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Total No. Of wallet credit</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $wallet }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total No. Of winner</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$winner}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="row">
          <div class="col-sm-8 mb-3">
            <div class="card border-left-primary shadow ">
              <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 d-flex align-items-center">
                  <div>Current Yantra Timeslot</div>
                  <div class="ml-auto" id="yantra_total_points" style="font-size: 28px;"></div>
                  <div class="ml-auto" id="yantra_counter" style="font-size: 18px;"></div>
                  <div class="ml-auto" id="yantra_timeslot"> </div>
                </div>

                <div class="row" id="yantra_games_data"> </div>
              </div>
            </div>
          </div>

          <!-- <div class="col-sm-4 mb-3">
          <div class="card border-left-primary shadow ">
              <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 d-flex align-items-center">
                  <div>Last 5 winning game</div>
                </div>
                @if(!empty($last_games))
                @foreach($last_games as $time => $game)
                <hr />
                <div class="d-flex">
                  <div>{{ $game ?: 'No Result' }}</div>
                  <div class="ml-auto">
                    {{ $time }}
                  </div>
                </div>
                @endforeach
                @endif
              </div>
            </div>
          </div> -->
          <div class="col-sm-4 mb-3">
            <div class="card border-left-primary shadow ">
              <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 d-flex align-items-center">
                  <div>Last 5 winning game</div>
                </div>
                @if(!empty($last_win))
                @foreach($last_win as $game)
                <hr />
                <div class="d-flex">
                  <div>{{ $game->game ? $game->game->name : 'N/A' }}</div>
                  <div class="ml-auto">
                    {{ $game->timeslot_id }}
                  </div>
                </div>
                @endforeach
                @endif
              </div>
            </div>
          </div>
          

          <div class="col-sm-12 mb-3">
            <div class="card border-left-primary shadow ">
              <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 d-flex">
                  <div>Current City Timeslot</div>
                  <div class="ml-auto" id="city_timeslot"> </div>
                </div>

                <div class="row" id="city_games_data"> </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4 mb-3">
          <div class="card border-left-primary shadow ">
              <div class="card-body">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 d-flex align-items-center">
                  <div>User Wallet</div>
                </div>
                @if(!empty($user_wallet))
                @foreach($user_wallet as $uw)
                @if($uw->user ? $uw->user->name : 'N/A' == '')
                <hr />
                <div class="d-flex">
                  <div>{{ $uw->user ? $uw->user->name : 'N/A'}}</div>
                  <div class="ml-auto">
                    {{ $uw->wallet }}
                  </div>
                </div>
                @else
                
                @endif
                @endforeach
                @endif
              </div>
            </div>
          </div>
        </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Yantra Game 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->


<script>
const RUN_AUTO_SCRIPT_GAME = 1;
</script>
