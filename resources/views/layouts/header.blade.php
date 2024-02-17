  <nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
      <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        <!-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> -->
      </ul>
     
    </form>
    <ul class="navbar-nav navbar-right">
    
      <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        @if (empty(Auth::user()->photo ))
          <img alt="image" src="{{asset('assets/img/avatar')}}/avatar-1.png" class="rounded-circle mr-1">
        @else
          <!-- <img alt="image" src="{{url('/')}}/assets/img/avatar/{{Auth::user()->photo}}" class="rounded-circle mr-1"> -->
          <img alt="image" src="{{asset('assets/img/avatar')}}/{{Auth::user()->photo}}" class="rounded-circle mr-1">
        @endif
        <div class="d-sm-none d-lg-inline-block">{{Auth::user()->name }}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
          @if (Auth::user()->hasVerifiedEmail())
            <div class="dropdown-title">Manage Account</div>
              <a href="{{route('user.show', Auth::user()->id)}}" class="dropdown-item has-icon"><i class="far fa-user"></i> Profile</a>
              <a href="{{route('setting.index')}}" class="dropdown-item has-icon"><i class="fas fa-wrench"></i> Setting</a>
            <div class="dropdown-divider"></div>
          @endif
          <a href="{{route('logout')}}" class="dropdown-item has-icon text-danger"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </a>
        </div>
      </li>
    </ul>
  </nav>