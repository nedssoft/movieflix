@extends('layouts.app1')

@section('content')
@php $page_name = 'playmovie'; @endphp
@section('header')
@include('browser-header')
@endsection


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
	background-image: url({{ $audio->poster }}); 
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

				.intrinsic-container audio {
				  position: absolute;
				  top:50%;
				  left: 0;
				  width: 100%;
				  /*height: 100%;*/
				}
				</style>
				
				<div class="intrinsic-container intrinsic-container-16x9">
  					<audio controls controlsList="nodownload" autoplay>
  						<source src="{{$audio->url}}" type="audio/mpeg">
  					</audio>
				</div>
				
			</div>
		</div>
	</div>
</div>
<div class="container" style="margin-top: 30px;">
	<div class="row">
		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-2">
					<img src="{{$audio->poster}}" style="height: 60px; margin:20px;" />
				</div>
				<div class="col-lg-10">
					<!-- VIDEO TITLE -->
					<h3>
						{{$audio->name}}
					</h3>
					<!-- RATING CALCULATION -->
					
				</div>
			</div>
		</div>
		
		<div class="col-lg-4">
			<!-- ADD OR DELETE FROM PLAYLIST -->
			<span id="mylist_button_holder">
			</span>
			<span id="mylist_add_button" style="display:none;">
			<a href="#" class="btn btn-danger btn-md" style="font-size: 16px; margin-top: 20px;" 
				onclick=""> 
			<i class="fa fa-plus"></i> Add to My list
			</a>
			</span>
			<span id="mylist_delete_button" style="display:none;">
			<a href="#" class="btn btn-default btn-md" style="font-size: 16px; margin-top: 20px;" 
				onclick=""> 
			<i class="fa fa-check"></i> Added to My list
			</a>
			</span>
			<!-- MOVIE GENRE -->
			<div style="margin-top: 10px;">
				<strong>Genre</strong> : 
				<a href="#">
				{{ title_case($audio->genre->name) }}
				</a>
			</div>
			<!-- MOVIE YEAR -->
			<div>
				<strong>Year</strong> : {{ $audio->year}}
			</div>
			
		</div>
	</div>
	<div class="row" style="margin-top:20px;">
		<div class="col-lg-12">
			<div class="bs-component">
				<ul class="nav nav-tabs">
					<li class="active" style="width:33%;">
						<a href="#about" data-toggle="tab">
						About
						</a>
					</li>
					
					<li style="width:34%;">
						<a href="#more" data-toggle="tab">
						More
						</a>
					</li>
				</ul>
				<div id="myTabContent" class="tab-content">
					<!-- TAB FOR TITLE -->
					<div class="tab-pane active in" id="about">
						<p>
							{{ $audio->description}}
						</p>
					</div>
					<!-- TAB FOR ACTORS -->
				
					<!-- TAB FOR SAME CATEGORY MOVIES -->
					<div class="tab-pane  " id="more">
						<p>
						<div class="content">
							<div class="grid">
								@if (!is_null($audio->related()))
									@foreach ($audio->related() as $related)

										@if($related->id !== $audio->id)
										@php 

										$name	=	$related['name'];
										$link	=	route('play.audio', [$related->id, str_slug($related->name)]);
										$thumb	=	$related->poster;
										@endphp
				
										@include('audio-thumb')
										@endif
									@endforeach
								@endif
										
							</div>
						</div>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr style="border-top:1px solid #333;">
	
</div>


@endsection