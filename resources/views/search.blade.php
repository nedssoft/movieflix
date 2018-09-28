@extends('layouts.app1')

@section('content')
@php $page_name = 'home'; @endphp
@include('browser-header')
<div class="row" style="margin:80px 60px 20px 60px;">
	<h4>
		Search result for : {{$_GET['search_key']}}
	</h4>
	<div class="content">
		<div class="grid">
				@isset($movies)
				@foreach ($movies as $m)
				
					@php
						$title	=	$m['title'];
						$link	=	route('view.movie', $m->id);
						$thumb	=	$m->poster;
						
						@endphp
						@include('thumb')
				@endforeach
				@endisset
				
				
		</div>
	</div>
	<div style="clear: both;"></div>
	<ul class="pagination">
		
	</ul>
</div>
@endsection