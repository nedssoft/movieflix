
<style>
	.movie_thumb{}
	.btn_opaque{font-size:20px; border: 1px solid #939393;text-decoration: none;margin: 0px;background-color: rgba(0, 0, 0, 0.74); color: #ff0000;}
	.btn_opaque:hover{border: 1px solid #939393;text-decoration: none;background-color: rgba(57, 57, 57, 0.74);color:#ff0000;}
</style>
<figure class="effect-sadie col-lg-2 col-md-4 col-sm-6">
	<img src="{{$thumb}}" alt="{{$title}}" />
	<figcaption>
		<p>
			<img src="{{asset('frontend/flixer/images/play.png')}}" style="width:60px;"/>
			<br>
			<span class="text-red" style="font-size: 20px;">
			{{ $title}}
			</span>
		</p>
		<a href="{{$link}}">View more</a>
	</figcaption>
</figure>