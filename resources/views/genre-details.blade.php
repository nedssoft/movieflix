

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



<!-- MY LIST, GENRE WISE LISTING & SLIDER -->

@if (count($genre->movies)> 0 )
<div class="row" style="margin:100px 20px 0px 20px; min-height: 500px">
	<h3 style="color: #fff">{{ title_case($genre->name)}}</h3>
	<div class="content">
		<div class="movies-block grid">

				@foreach ($genre->movies as $m)
					@php
					$title	=	$m['title'];
					$link	=	route('view.movie', [$m->id, str_slug($m->title)]);
					$thumb	=	$m->poster;
					
					@endphp
					@include('thumb')
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