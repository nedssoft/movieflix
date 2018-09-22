@extends('layouts.app1')

@section('content')
@php $page_name = 'playmovie'; @endphp
@include('browser-header')


<style>
	.movie_thumb{}
	.btn_opaque{font-size:20px; border: 1px solid #939393;text-decoration: none;margin: 10px;background-color: rgba(0, 0, 0, 0.74); color: #fff;}
	.btn_opaque:hover{border: 1px solid #939393;text-decoration: none;background-color: rgba(57, 57, 57, 0.74);color:#fff;}
	.video_cover {
	position: relative;padding-bottom: 30px;
	}
	.video_cover:after {
	content : "";
	display: block;
	position: absolute;
	top: 0;
	left: 0;
	background-image: url({{ $movie->poster }}); 
	width: 100%;
	height: 100%;
	opacity : 0.2;
	z-index: -1;
	background-size:cover;
	}
	.select_black{background-color: #000;height: 45px;padding: 12px;font-weight: bold;color: #fff;}
	.profile_manage{font-size: 25px;border: 1px solid #ccc;padding: 5px 30px;text-decoration: none;}
	.profile_manage:hover{font-size: 25px;border: 1px solid #fff;padding: 5px 30px;text-decoration: none;color:#fff;}
</style>
<!-- VIDEO PLAYER -->

<div class="video_cover">
	<div class="container" style="padding-top:100px; text-align: center;">
		<div class="row">
			<div class="col-lg-12">
				
				
				<style>
				.intrinsic-container {
				  position: relative;
				  height: 0;
				  overflow: hidden;
				}

				/* 16x9 Aspect Ratio */
				.intrinsic-container-16x9 {
				  padding-bottom: 56.25%;
				}

				/* 4x3 Aspect Ratio */
				.intrinsic-container-4x3 {
				  padding-bottom: 75%;
				}

				.intrinsic-container iframe {
				  position: absolute;
				  top:0;
				  left: 0;
				  width: 100%;
				  height: 100%;
				}
				</style>
				<div class="intrinsic-container intrinsic-container-16x9">
  					<iframe src="{{$movie->url}}" allowfullscreen style="border:0px; width:100%; height:100%;"></iframe>
				</div>
				
				<!-- loads jwplayer as video player -->
			{{-- 	<script src="https://content.jwplatform.com/libraries/O7BMTay5.js"></script>
				<div id="video_player_div">{{ $movie->title}}</div>
				<script>
					jwplayer("video_player_div").setup({
						"file": "{{ $movie->url}}",
						"image": "{{ $movie->poster}}",
						"width": "100%",
						aspectratio: "16:9",
						listbar: {
						  position: 'right',
						  size: 260
						},
					  });
				</script> --}}
				
			</div>
		</div>
	</div>
</div>
<!-- VIDEO DETAILS HERE -->


@endsection