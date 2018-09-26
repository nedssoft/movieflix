@extends('layouts.admin.app')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="">  
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel" style="min-height: 530px">
					<div class="x_title d-flex">
						<a class="btn btn-md btn-primary upload-video" data-toggle="modal" data-target="#upload">Upload Movie</a>
						<a class="btn btn-md btn-primary upload-video" data-toggle="modal" data-target="#featured-movie">Set Featured Movie</a>
						<a class="btn btn-md btn-primary upload-video" data-toggle="modal" data-target="#live-tv">Upload Live TV</a>
						<a class="btn btn-md btn-primary upload-video" data-toggle="modal" data-target="#music">Upload Music</a>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>S/No</th>
									<th>Title</th>
									<th>Description</th>
									<th>Rating</th>
									<th>Year</th>
									<th>Casts</th>
									<th>Date</th>
									
									<th><i class="fa fa-cog"></i></th>
									<th><i class="fa fa-cog"></i></th>
								</tr>
							</thead>
							<tbody>
								@isset($videos)
			            		@foreach ($videos as $video)
									<tr>
										@include('admin.edit-video')
										<td>{{ $loop->index +1}}</td>
										<td>{{ $video->title}}</td>
										<td>{{ $video->description}}</td>
										<td>{{ $video->rating}}</td>
										<td>{{ $video->year}}</td>
										<td>{{ $video->casts}}</td>
										<td>{{ $video->created_at}}</td>
										
										<td><a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#edit-video{{$video->id}}" title="Edit">Edit
                                			</a></td>
                                		<td><a class="btn btn-xs btn-danger" href="{{ route('admin.movie.delete', $video->id)}}" title="Delete?" onclick="return confirm('Are you sure about this ?')">Delete
                                			</a></td>
									</tr>
			            			

									@endforeach
									@endisset
							
							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Upload Video</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('admin.video.upload')}}" 
				enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label for="exampleFormControlFile1"></label>
						<input type="file" class="form-control-file" id="exampleFormControlFile1" name="video" >
						@if ($errors->has('video'))
							<span class="text-danger">{{ $errors->first('video')}}</span>
						@endif
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Title</label>
						<input type="text" class="form-control"  name="title" >
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Description</label>
						<input type="text" class="form-control"  name="description" >
					
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Genre</label>
						<select class="form-control chosen-select" name="genre_id">
							@foreach ($genres as $g)
							<option value="{{ $g->id}}">{{ $g->name}}</option>
							@endforeach
						</select> 
					
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" id="submit-button" class="btn btn-primary">Save changes</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="music" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Upload Video</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('music.video.upload')}}" 
				enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label for="exampleFormControlFile1"></label>
						<input type="file" class="form-control-file" id="exampleFormControlFile1" name="video">
						@if ($errors->has('video'))
							<span class="text-danger">{{ $errors->first('video')}}</span>
						@endif
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Title</label>
						<input type="text" class="form-control"  name="title" >
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Description</label>
						<input type="text" class="form-control"  name="description" >
					
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Genre</label>
						<select class="form-control chosen-select" name="genre_id">
							@isset($genres)
								@foreach ($genres as $g)
								<option value="{{ $g->id}}">{{ $g->name}}</option>
								@endforeach
								@endisset
						</select> 
					
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Genre</label>
						<select class="form-control chosen-select" name="music_id">
							@isset($music)
								@foreach ($music as $m)
								<option value="{{ $m->id}}">{{ $m->name}}</option>
								@endforeach
							@endisset
						</select> 
					
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" id="submit-button" class="btn btn-primary">Save changes</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="live-tv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Live TV</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('admin.tv.upload')}}">
					@csrf
					<div class="form-group">
						<label for="exampleFormControlFile1">URL</label>
						<input type="text-danger" class="form-control" id="exampleFormControlFile1" name="url" >
						@if ($errors->has('url'))
							<span class="text-danger">{{ $errors->first('url')}}</span>
						@endif
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Title</label>
						<input type="text" class="form-control"  name="title" >
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Description</label>
						<input type="text" class="form-control"  name="description" >
					
					</div>
					<div class="form-group">
						<label for="exampleFormControlFile1">Genre</label>
						<select class="form-control chosen-select" name="genre_id">
							@foreach ($genres as $g)
							<option value="{{ $g->id}}" {{strtolower($g->name) === strtolower('Live TV') ? 'selected' : ''}}>{{ $g->name}}</option>
							@endforeach
						</select> 
					
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" id="submit-button" class="btn btn-primary">Save changes</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="featured-movie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Featured Movie</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('featured.movie')}}">
					@csrf
					<div class="form-group">
						<label for="exampleFormControlFile1"></label>
							<select name="type" class="form-control chosen-select">
				              <option value="basic">Basic</option>
				              <option value="standard">Standard</option>
				              <option value="premium">Premium</option>
				            </select>
					</div>
					
					<div class="form-group">
						<label for="exampleFormControlFile1">Movie</label>
						<select class="form-control chosen-select" name="movie_id">
							@foreach ($videos as $m)
							<option value="{{ $m->id}}">{{ $m->title}}</option>
							@endforeach
						</select> 
					
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" id="submit-button" class="btn btn-primary">Save changes</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
	@push('scripts')
		<script type="text/javascript">
		
			@if ($errors->has('video'))
				$('#upload').modal('show');
			@endif

			$('#upload').on('show.bs.modal', function(e){
			
				$(e.currentTarget).find('#submit-button').click(function(e){
					
					$(this).html('<i class="fa fa-spinner fa-spin"></i>');
				});
			});

		</script>

	@endpush
@endsection






