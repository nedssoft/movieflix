<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
@include('layouts.admin.head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      @include('layouts.admin.sidebar')
      @include('layouts.admin.topmenu')
      @yield('content')


    </div>
  </div>

  @include('layouts.admin.footer')

  @if(Session::has('success'))   
  <script>
    success('Yea!', "{{Session::get('success')}}")
  </script>
  @endif

  @if(Session::has('error'))
  <script>
    error('Oops!', "{{Session::get('error')}}")
  </script>
  @endif

<head>
</body>
</html>
