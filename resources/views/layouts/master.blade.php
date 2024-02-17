
<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title') &mdash; {{config('app.name')}}</title>
  @include('layouts.link')
  @stack('pages-style')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
    @include('layouts.header')
    @include('layouts.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{$section_header}}</h1>
            <div class="section-header-breadcrumb">
              {{-- <div class="breadcrumb-item active"><a href="{{route('qualification.index')}}">{{$section_header}}</a></div> --}}
              {{-- <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div> --}}
              {{-- <div class="breadcrumb-item">Form</div> --}}
             
            </div>
          </div>
    
          @yield('content')
        </section>
        @yield('modal')
      </div>
      @include('layouts.footer')
    </div>
  </div>
@stack('before-scripts')
  @include('layouts.script')

  <!-- Page Specific JS File -->
  @stack('page-script')
  @stack('after-script')
</body>
</html>
