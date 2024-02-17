  <div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <img src="{{asset('assets/img/favicon-menu.svg')}}" width="25%" class="img-circle">
        <a href="#"><span>{{config('app.name')}}</span></a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <img src="{{asset('assets/img/favicon-menu.svg')}}" width="100%" class="img-circle">
      </div>

      <ul class="sidebar-menu">

        @if (Auth::user()->hasVerifiedEmail())

          <li class="menu-header">Menus</li>

          <li class="{{ (request()->routeIs('dashboard')) ? 'active' : null }}">
            <a href="{{route('dashboard')}}" class="nav-link"><i class="fas fa-grip-horizontal"></i><span>Dashboard</span></a>
          </li>

          @role('Admin')
          <li class="{{ (request()->is('dashboard/master/*')) ? 'nav-item dropdown active' : 'nav-item dropdown' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-shield"></i><span>Admin</span></a>
            <ul class="dropdown-menu">
              <li class="{{ request()->routeIs('template_category.*') ? 'active' : null }}">
                <a class="nav-link" href="{{route('template_category.index')}}"><i class="fa fa-th-large"></i><span>Template Category</span></a>
              </li>
              <li class="{{ request()->routeIs('music.*') ? 'active' : null }}">
                <a class="nav-link" href="{{route('music.index')}}"><i class="fa fa-music"></i><span>Musik</span></a>
              </li>
              <li class="{{ request()->routeIs('admininvoicepayment.*') ? 'active' : null }}">
                <a class="nav-link" href="{{route('admininvoicepayment.index')}}"><i class="fa fa-money-bill-wave"></i><span>Pembayaran Masuk</span></a>
              </li>
              <li class="{{ request()->routeIs('feedback.*') ? 'active' : null }}">
                <a class="nav-link" href="{{route('feedback.index')}}"><i class="fa fa-comment-alt"></i><span>Feedback</span></a>
              </li>
            </ul>
          </li>
          @endrole

          <li class="{{ (request()->is('dashboard/wedding/*')) ? 'nav-item dropdown active' : 'nav-item dropdown' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-heart"></i><span>Wedding</span></a>
            <ul class="dropdown-menu">
              <li class="{{ (request()->is('invitation/wedding*')) ? 'active' : null }}">
                <a class="nav-link" href="{{route('invitation.index',[
                    strtolower(Constant::CODE_WEDDING),
                    App\Models\Template_user::where('user_id',Auth::user()->id)->where('template_category_id',App\Models\Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail()->id)->firstOrFail()->user_url
                  ])}}" target="_blank"><i class="fa fa-envelope"></i><span>Link Undangan</span></a>
              </li>
              <li class="{{ (request()->is('slideshow/wedding*')) ? 'active' : null }}">
                <a class="nav-link" href="{{route('slideshow.index',[
                    strtolower(Constant::CODE_WEDDING),
                    App\Models\Template_user::where('user_id',Auth::user()->id)->where('template_category_id',App\Models\Template_category::where('name',Constant::CODE_WEDDING)->firstOrFail()->id)->firstOrFail()->user_url
                  ])}}" target="_blank"><i class="fa fa-image"></i><span>Link Slideshow</span></a>
              </li>
              <li class="{{ (request()->is('dashboard/wedding/template*')) ? 'active' : null }}">
                <a class="nav-link" href="/dashboard/wedding/template"><i class="fa fa-th-large"></i><span>Template</span></a>
              </li>
              <li class="{{ (request()->is('dashboard/wedding/music*')) ? 'active' : null }}">
                <a class="nav-link" href="/dashboard/wedding/music"><i class="fa fa-music"></i><span>Musik</span></a>
              </li>
              <li class="{{ (request()->is('dashboard/wedding/bride*')) ? 'active' : null }}">
                <a class="nav-link" href="{{route('bride.index')}}"><i class="fa fa-heart"></i><span>Pengantin</span></a>
              </li>
              <li class="{{ (request()->is('dashboard/wedding/event*')) ? 'active' : null }}">
                <a class="nav-link" href="{{route('event.index')}}"><i class="fa fa-calendar-day"></i><span>Acara</span></a>
              </li>
              <li class="{{ (request()->is('dashboard/wedding/gallery*')) ? 'active' : null }}">
                <a class="nav-link" href="{{route('gallery.index')}}"><i class="fa fa-images"></i><span>Galeri</span></a>
              </li>
              <li class="{{ (request()->is('dashboard/wedding/story*')) ? 'active' : null }}">
                <a class="nav-link" href="{{route('story.index')}}"><i class="fa fa-dove"></i><span>Love Story</span></a>
              </li>
              <li class="{{ (request()->is('dashboard/wedding/guest*')) ? 'active' : null }}">
                <a class="nav-link" href="{{route('guest.index')}}"><i class="fa fa-users"></i><span>Guest</span></a>
              </li>
              <li class="{{ (request()->is('dashboard/wedding/greeting*')) ? 'active' : null }}">
                <a class="nav-link" href="{{route('greeting.index',strtolower(Constant::CODE_WEDDING))}}"><i class="fa fa-comments"></i><span>Greeting</span></a>
              </li>
              <li class="{{ (request()->is('dashboard/wedding/subscribe*')) ? 'active' : null }}">
                <a class="nav-link" href="{{route('subscribe.index')}}"><i class="fa fa-star"></i><span>Subscribe</span></a>
              </li>
              <li class="{{ (request()->is('dashboard/wedding/order*')) ? 'active' : null }}">
                <a class="nav-link" href="{{route('order.redirect','notyetpaid')}}"><i class="fa fa-shopping-bag"></i><span>Pesanan</span></a>
              </li>
            </ul>
          </li>

          <li class="{{ (request()->is('dashboard/feedback/*')) ? 'active' : null }}">
            <a href="{{route('feedback.create')}}" class="nav-link"><i class="fas fa-comment-alt"></i><span>Feedback</span></a>
          </li>

        @endif

          <!-- <li class="menu-header">Contact</li> -->

          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <!-- <a href="https://wa.me/6281513947715" class="btn btn-primary btn-lg btn-block btn-icon-split" target="_blank"> -->
            <a href="https://api.whatsapp.com/send/?phone=6281513947715&text=Hallo%20Kak,%20mau%20tanya%20dong..." class="btn btn-primary btn-lg btn-block btn-icon-split" target="_blank">
              <i class="fa fa-phone"></i>Whatsapp Me
            </a>
          </div>

      </ul>

    </aside>
  </div>