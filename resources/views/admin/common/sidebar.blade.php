
<!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin/home') }}">
        <!-- <img src="{{ url('imgs/logo/logo.png') }}" alt="" style="max-height: 50px;"> -->
        Yantra Game
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{  url('admin/home') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      
      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Master
      </div>
      
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#coupan" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-folder"></i>
          <span>Timeslot</span>
        </a>
        <div id="coupan" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ url('admin/timeslot/create') }}">Add</a>
            <a class="collapse-item" href="{{ url('admin/timeslot/') }}">View</a>
          </div>
        </div>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="{{  url('admin/timeslot/?g_type=yantra') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Timeslot</span></a>
      </li> -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#timeslot" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-folder"></i>
          <span>Timeslot</span>
        </a>
        <div id="timeslot" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            
            <a class="collapse-item" href="{{  url('admin/timeslot/?g_type=yantra') }}">Yantra</a>
            <a class="collapse-item" href="{{  url('admin/timeslot/?g_type=city') }}">City</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#yantra" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-folder"></i>
          <span>Yantra</span>
        </a>
        <div id="yantra" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            
            <a class="collapse-item" href="{{ url('admin/game/create?type=yantra') }}">Add</a>
            <a class="collapse-item" href="{{ url('admin/game?type=yantra') }}">View</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#city" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-folder"></i>
          <span>City</span>
        </a>
        <div id="city" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ url('admin/game/create?type=city') }}">Add</a>
            <a class="collapse-item" href="{{ url('admin/game?type=city') }}">View</a>
          </div>
        </div>
      </li>
      
      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sliderMenu1" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-folder"></i>
          <span>Game yantra</span>
        </a>
        <div id="sliderMenu1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ url('admin/game/create?type=yantra') }}">Add</a>
            <a class="collapse-item" href="{{ url('admin/game') }}">View</a>
          </div>
        </div>
      </li> -->

      
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        User 
      </div>
      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#wallet" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-folder"></i>
          <span>Wallet Credit</span>
        </a>
        <div id="wallet" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ url('admin/wallet/create') }}">Credit/Debit</a>
            <!-- <a class="collapse-item" href="{{ url('admin/wallet/debit') }}">Debit</a> -->
            <a class="collapse-item" href="{{ url('admin/wallet') }}">View</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/placepoint') }}" >
          <i class="fas fa-fw fa-wrench"></i>
          <span>Yantra Game Points</span></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/timeslote_schedule/create') }}" >
          <i class="fas fa-fw fa-folder"></i>
          <span>Timeslot Schedule</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/winner') }}" >
          <i class="fas fa-fw fa-folder"></i>
          <span>Winner</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/win_history') }}" >
          <i class="fas fa-fw fa-folder"></i>
          <span>Win History</span></a>
      </li>
      @php 
        $date = date('Y-m-d');
      @endphp
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/point_history?date='.$date.'&type=yantra') }}" >
          <i class="fas fa-fw fa-folder"></i>
          <span>Point History</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-user"></i>
          <span>User</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <a class="collapse-item" href="{{ url('admin/add-category') }}">Category</a> -->
            <a class="collapse-item" href="{{ url('admin/user/create') }}">Add</a>
            <a class="collapse-item" href="{{ url('admin/user/') }}">View</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pages" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-user"></i>
          <span>Pages</span>
        </a>
        <div id="pages" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <!-- <a class="collapse-item" href="{{ url('admin/add-category') }}">Category</a> -->
            <a class="collapse-item" href="{{ url('admin/page/create') }}">Add</a>
            <a class="collapse-item" href="{{ url('admin/page/') }}">View</a>
          </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/setting/1/edit') }}" >
          <i class="fas fa-fw fa-wrench"></i>
          <span>Setting</span></a>
      </li>
      
      

      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-sign-out-alt fa-chart-area"></i>
          <span>LogOut</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
