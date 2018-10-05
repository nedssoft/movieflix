@extends('layouts.app1')

@section('content')
<div style="height:93vh;width:100%;background-image: url({{asset('frontend/flixer/images/login_bg.jpg')}}">
	<!-- logo -->
	<div style="float: left;">
		<a href="#">
		<img src="{{asset('img/logo.png')}}" style="margin: 18px 40px; height: 50px;" />
		</a>
	</div>
	<div class="row">
		<div class="col-lg-4 col-lg-offset-4" style="clear: both;">
			<div style="background-color: #f3f3f3; padding: 30px;">
				
				<!-- ERROR MESSAGE -->
			@if ($errors->has('username'))
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ $errors->first('username')}}
				</div>
			@endif
			@if (session()->has('message'))
				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					{{ session('message')}}
				</div>
			@endif
				<form method="post" action="{{route('login')}}">
					@csrf
					<h3 class="black_text">Sign in</h3>
					<div class="black_text">
						Username
					</div>
					<div class="black_text">
						<input type="text" name="username" style="padding: 10px; width:100%;" />
					</div>
					<div class="black_text" style="margin-top: 20px;">
						Password
					</div>
					<div class="black_text">
						<input type="password" name="password" id="password" style="padding: 10px; width:100%;" />
					</div>
					<div class="black_text" style="margin-top: 10px">
						<input type="checkbox" id="show-passowrd" />
						<label class="black_text" style="font-weight: normal;">Show Password</label>
					</div>
					<button  type="submit" class="btn btn-danger" style=" width: 100%; margin: 20px 0px;"> Sign in </button>
				</form>
				<hr>
				<a href="#">Forget password?</a>
			</div>
		</div>
	</div>
</div>
@push('scripts')
	<script >
		$(document).ready(function(){

			$('#show-passowrd').click(function(){

				if ($('#password').attr('type') === 'password'){

					$('#password').attr('type', 'text');
				}
				else{
					$('#password').attr('type', 'password');
				}
			})
		});
	</script>
@endpush
@endsection
