@extends('layouts.app1')

@section('content')
@php $page_name = 'home'; @endphp
@section('header')
@include('external.browser-header')
@endsection
<div class="row" style="margin:80px 60px 20px 60px; min-height: 500px">
	@if (count($movies) || count($audios))
	<h4>
		Search result for : {{$_GET['search_key']}}
	</h4>
	@else
	<h4 class="h">
		No result for : {{$_GET['search_key']}}
	
	</h4>
	@endif
	<div class="content">
		<div class="grid gd">
				@isset($movies)
				@foreach ($movies as $m)
				
					@php
						$title	=	$m['title'];
						$link	=	route('view.movie.external', [$m->id, str_slug($title)]);
						$thumb	=	$m->poster;
						
						@endphp
						@include('external.thumb')
				@endforeach

				@endisset
				
			@isset($audios)
			@foreach ($audios as $audio)
						@php
						$name	=	$audio['name'];
						$link	=	route('play.audio.external', [$audio->id, str_slug($name)]);
						$thumb	=	$audio->poster;
						
						@endphp
						@include('external.audio-thumb')
				@endforeach	
			@endisset

		</div>

	</div>
	{{-- <div style="clear: both;"></div> --}}
	
</div>
@endsection