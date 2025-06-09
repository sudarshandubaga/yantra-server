<div class="col-sm-4">
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            <h4 class="mt-15">{{ ucwords(auth()->user()->name) }}</h4>
            <p>({{ auth()->user()->login }})</p>
            @php
                $id = auth()->user()->id;
                $points = App\Model\Point::where('uid', $id)->get();
            @endphp
            <div style="position: absolute; top: 24%; right: 5%;"><img src="{{url('imgs/point.png')}}" width="20px">
            @if(count($points)!=0)
                @foreach($points as $point)
                {{ $point->point }} Points
                @endforeach
            @else
                0 Points
            @endif
            </div>
        </div>
        <ul class="list-group">
            <li class="list-group-item">
                <a href="{{ route('profile') }}"><i class="icon-user" style="background: none;"></i> Profile</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('edit_profile') }}"><i class="icon-pencil"></i> Edit Profile</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('my_orders') }}"><i class="icon-cart"></i> My Orders</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('wishlist') }}"><i class="icon-heart"></i> My Wishlist</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('address') }}"><i class="fa fa-map-marker" style="padding: 0px 7px;"></i> My Address</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('change_password') }}"><i class="icon-lock"></i> Change Password</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('logout') }}"><i class="icon-logout"></i> Logout</a>
            </li>
        </ul>
    </div>
</div>
