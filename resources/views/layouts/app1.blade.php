<!doctype html>
<html>
<head>
	<title>Movieflix</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('img/item_thumb.png')}}">
    <link rel="stylesheet" href="{{asset('frontend/flixer/bootstrap.css')}}" media="screen">
    {{-- <link rel="stylesheet" href="{{ asset('frontend/flixer/custom.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('frontend/flixer/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/flixer/hovercss/demo.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/flixer/hovercss/set1.css')}}" />
    @stack('styles')
    
    <style>
		.black_text{color:#000; background-color: #f3f3f3;}
		.blue_text{color: #0080ff;}

    body {
       margin:0 !important;
       padding:0px !important;
       padding-bottom: 0px !important;
       height:100% !important;
       -webkit-user-select: none;  /* Chrome all / Safari all */
      -moz-user-select: none;     /* Firefox all */
      -ms-user-select: none;      /* IE 10+ */
      -o-user-select: none;
      user-select: none;
    }
    #app{
      min-height: 100%;
      position: relative;
      margin: 0;
    }
    #body {
       padding:10px;
       padding-bottom:100px;   /* Height of the footer */
    }
    #footer-id {
       position:absolute;
       bottom:0px !important;
       width:100%;
       height:100px;   /* Height of the footer */
       background: #202020;
       /*padding-top: 50px;*/
    }
    .list-unstyled >li {
      display: inline-block;
      padding: 20px;
    }
    .foot {
     /* padding: 50px;
      margin-top: ;*/
    }
	</style>
</head>

<body style="background-color: #202020">
  <div id="app">
    @yield('header')
  <div id="body">
    @yield('content')
  </div>
  <footer id="footer-id">
    <div class="row">
      <div class="col-lg-12 text-center foot" >
        <ul class="list-unstyled">
          <li><a href="#">Faq</a></li>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Refund Policy</a></li>
        </ul>
        <p class="text-center">Alright Reserved <i class="fa fa-copyright"></i> Movieflix Ng {{date('Y')}}.</p>
      </div>
    </div>
    
  </footer>
</div>
  
      <script>
        window.oncontextmenu = function () {
            
            return false;
        }
    </script>
 
  <script src="{{asset('frontend/flixer/jquery-1.10.2.min.js')}}"></script>
  <script src="{{asset('frontend/flixer/bootstrap.min.js')}}" ></script>
  @stack('scripts')
</body>
</html>








