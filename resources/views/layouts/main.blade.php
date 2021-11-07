<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('images/logoku.png') }}" type="image/x-icon">

  <title>@yield('title')</title>
  @include('layouts/css')
  @yield('css')
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      {{-- Sidebar --}}
      @include('layouts/sidebar')
      {{-- End Of Sidebar --}}

      <!-- top navigation -->
      @include('layouts/navbar')
      <!-- /top navigation -->

      @yield('content')

      @include('layouts/js')
      @include('sweetalert::alert')
      @yield('js')
    </div>
  </div>
</body>
</html>