<!doctype html>
<html>
<head>
	<title>Movieflix</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('global/item_thumb.png')}}">
    <link rel="stylesheet" href="{{asset('frontend/flixer/bootstrap.css')}}" media="screen">
    <link rel="stylesheet" href="{{ asset('frontend/flixer/custom.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/flixer/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/flixer/hovercss/demo.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/flixer/hovercss/set1.css')}}" />
    @stack('styles')
    <script src="{{asset('frontend/flixer/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('frontend/flixer/bootstrap.min.js')}}" ></script>
    <style>
		.black_text{color:#000; background-color: #f3f3f3;}
		.blue_text{color: #0080ff;}
	</style>
</head>

<body style="background-color: #f3f3f3">
	@yield('content')

<footer>
  <div class="row">
    <div class="col-lg-12">
      <ul class="list-unstyled">
        <li><a href="#">Faq</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Refund Policy</a></li>
      </ul>
      <p>Designed & Developed by <a href="#" rel="nofollow">Harryson Daniels</a>. <i class="fa fa-copyright"></i> Movieflix Ng 2018.</p>
    </div>
  </div>
  @stack('scripts')
</footer>

</body>
</html>








