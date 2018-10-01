

@extends('layouts.app1')
	@php $page_name = 'home'; @endphp

@section('header')
@include('browser-header')
@endsection

@section('content')


<style>
	.movie_thumb{}
	.btn_opaque{font-size:20px; border: 1px solid #939393;text-decoration: none;margin: 10px;background-color: rgba(0, 0, 0, 0.74); color: #fff;}
	.btn_opaque:hover{border: 1px solid #939393;text-decoration: none;background-color: rgba(57, 57, 57, 0.74);color:#fff;}
</style>
<!-- TOP FEATURED SECTION -->

@isset($featured_movie)
<div style="height:85vh;width:100%;background-image: url({{ $featured_movie->poster }}); background-size:cover; margin-bottom: 100px">
	<div style="font-size: 85px;font-weight: bold;clear: both;padding: 200px 0px 0px 50px;color: #fff; ">
		{{$featured_movie->title}}
		<div style="font-size: 30px; letter-spacing: .2px; color: #fff; font-weight: 400;">
			{{ $featured_movie->description}}
		</div>
		<a href="{{ route('view.movie',[$featured_movie->id, str_slug($featured_movie->title)])}}" 
			class="btn btn-danger btn-lg" style="font-size: 20px;"> 
		<b><i class="fa fa-play"></i> PLAY</b>
		</a>
		<!-- ADD OR DELETE FROM PLAYLIST -->
		<span id="mylist_button_holder">
		</span>
		<span id="mylist_add_button" style="display:none;">
		<a href="#" class="btn  btn-lg btn_opaque"
			onclick=""> 
		<b><i class="fa fa-plus"></i> MY LIST</b>
		</a>
		</span>
		<span id="mylist_delete_button" style="display:none;">
		<a href="#" class="btn  btn-lg btn_opaque"
			onclick=""> 
		<b><i class="fa fa-check"></i> MY LIST</b>
		</a>
		</span>
	</div>
</div>
@else
@push('styles') <style type="text/css"> .separator{padding: 60px;}</style> @endpush
@endisset

<!-- MY LIST, GENRE WISE LISTING & SLIDER -->
@isset ($genres)
	@foreach ($genres as $row)
	@if (count($row->movies)> 0 && in_array(auth()->user()->type, (array)$row->types))
<div class="row" style="margin:0px 20px 0px 20px;">
	<h3 style="color: #fff">{{ $row->name}}</h3>
	<div class="content">
		<div class="grid">
			@isset ($row->movies)
				@foreach ($row->movies as $m)
					@php
					$title	=	$m['title'];
					$link	=	route('view.movie', [$m->id, str_slug($m->title)]);
					$thumb	=	$m->poster;
					
					@endphp
					@include('thumb')
			@endforeach
			@endisset
				
				
		</div>
	</div>
</div>
@endif
@endforeach
@endisset
@if (count($music))
	@foreach ( $music as $mu)
	@if ($mu->movies())
		<div class="row" style="margin:0px 20px 0px 20px;">
		<h3 style="color: #fff">{{ $mu->name}} Music</h3>
		<div class="content">
			<div class="grid">
				@if ($mu->movies())
					@foreach ($mu->movies() as $m)
						@php
						$title	=	$m['title'];
						$link	=	route('view.movie', [$m->id, str_slug($m->title)]);
						$thumb	=	$m->poster;
						
						@endphp
						@include('thumb')
				@endforeach
				@endif
					
					
			</div>
		</div>
	</div>
	@endif
	@endforeach
@endif

@if (count($audio_genres))
	@foreach ( $audio_genres as $a)
	@if (count($a->audios))
		<div class="row" style="margin:0px 20px;">
		<h3 style="color: #fff">{{ $a->name}} | Audio Music</h3>
		<div class="content">
			<div class="grid">
				
					@foreach ($a->audios as $audio)
						@php
						$name	=	$audio['name'];
						$link	=	route('play.audio', [$audio->id, str_slug($name)]);
						$thumb	=	$audio->poster;
						
						@endphp
						@include('audio-thumb')
				@endforeach		
			</div>
		</div>
	</div>
	@endif
	@endforeach
@endif

@endsection