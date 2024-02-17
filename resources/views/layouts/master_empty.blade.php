<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title') &mdash; {{config('app.name')}}</title>
  @include('layouts.link')
  @stack('pages-style')
</head>

<body>
  <div id="app">
  @yield('content')
  @yield('modal')
  </div>
  @stack('before-scripts')
  @include('layouts.script')

  <!-- Page Specific JS File -->
  @stack('page-script')
  @stack('after-script')
</body>
</html>