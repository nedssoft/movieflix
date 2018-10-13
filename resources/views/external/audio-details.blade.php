

@extends('layouts.app1')
	@php $page_name = 'home'; @endphp

@section('header')
@include('external.browser-header')
@endsection

@section('content')


<style>
	.movie_thumb{}
	.btn_opaque{font-size:20px; border: 1px solid #939393;text-decoration: none;margin: 10px;background-color: rgba(0, 0, 0, 0.74); color: #fff;}
	.btn_opaque:hover{border: 1px solid #939393;text-decoration: none;background-color: rgba(57, 57, 57, 0.74);color:#fff;}
	
</style>
<!-- TOP FEATURED SECTION -->



<!-- MY LIST, GENRE WISE LISTING & SLIDER -->

@if (count($audio_genre->audios))
		<div class="row" style="margin:100px 20px 0px 20px; min-height: 500px">
		<h3 style="color: #fff">{{ title_case($audio_genre->name) }} | Audio Music</h3>
		<div class="content">
			<div class="grid">
				
					@foreach ($audio_genre->audios as $audio)
						@php
						$name	=	$audio['name'];
						$link	=	route('play.audio.external', [$audio->id, str_slug($name)]);
						$thumb	=	$audio->poster;
						
						@endphp
						@include('external.audio-thumb')
				@endforeach		
			</div>
		</div>
	</div>
	
@else
<div class="row" style="margin:100px 20px 0px 20px; min-height: 500px">
	<h2>No content for this category yet</h2>
</div>
@endif


@endsection