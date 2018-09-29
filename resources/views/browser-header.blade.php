<!-- TOP HEADING SECTION -->
<style>
	.nav_transparent {
	padding: 10px 0px 10px; border: 1px;
	background: rgba(0,0,0,0.8); 
	}
	.nav_dark {
	background-color: #000;
	padding: 10px;
	}
</style>

	@php 
	if ($page_name == 'home' || $page_name == 'playmovie') {
		$nav_type = 'nav_transparent';
		}
	else 
		$nav_type = 'nav_dark';
	@endphp
	
<div class="navbar navbar-default navbar-fixed-top {{$nav_type}}" >
	<div class="container" style=" width: 100%;">
		<div class="navbar-header">
			<a href="{{ route('home')}}" class="navbar-brand">
				<img src="{{asset('img/logo.png')}}" style=" height: 32px;margin-right: 50px;" />
			</a>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
				<!-- MOVIES GENRE WISE-->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="" style="color: #e50914; font-weight: bold;">
						Movie <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						@if(movies())
						@foreach (movies() as $m)
							
						<li><a href="{{ route('view.movie', [$m->id, str_slug($m->title)])}}">
						 {{ $m->title}}
							</a>
						</li>
					
						@endforeach
						@endif
					</ul>
				</li>
				<!-- TV SERIES GENRE WISE-->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="" style="color: #e50914; font-weight: bold;">
						Tv Serial <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						@if(liveTv())
						@foreach (liveTv() as $m)
							
						<li><a href="{{ route('view.movie', [$m->id, str_slug($m->title)])}}">
						 {{ $m->title}}
							</a>
						</li>
					
						@endforeach
						@endif
					</ul>
				</li>
				<!-- MY LIST -->
				<li>
					<a href="#">My List</a>
				</li>
			</ul>
			<!-- PROFILE, ACCOUNT SECTION -->
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" style="padding:10px;">
					<img src="{{ asset('img/thumb1.png')}}" style="height:30px;" />
						{{ auth()->user()->username}}
					<span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="themes">
						
						<li><a href="{{ route('logout') }}"
							onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">Sign out</a>
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                         </li>
					</ul>
				</li>
			</ul>
			<!-- SEARCH FORM -->
			<form class="navbar-form navbar-right" method="GET" action="{{route('search')}}">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Titles, Audio, genres" 
						style="background-color: #000; border: 1px solid #808080;" name="search_key">
				</div>
				<button type="submit" onsubmit="return false" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></button>
			</form>
		</div>
	</div>
</div>
@php 
	if ($page_name == 'home' || $page_name == 'playmovie' || $page_name == 'playseries'){
		$padding_amount = '0px';
	}
	else
		$padding_amount = '50px';
	@endphp
<div style="padding: {{ $padding_amount}};"></div>



