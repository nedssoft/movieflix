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
						<a class="btn btn-md btn-primary upload-video" data-toggle="modal" data-target="#user-type">Set Use Type</a>
						<a class="btn btn-md btn-primary upload-video" data-toggle="modal" data-target="#add-genre">Add Genre</a>
						<a class="btn btn-md btn-primary upload-video" data-toggle="modal" data-target="#upload">Upload Audio</a>
						<a class="btn btn-md btn-primary upload-video" data-toggle="modal" data-target="#music">Upload Music</a>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>S/No</th>
									<th>Name</th>
									<th>Description</th>
									<th>Year</th>
									<th>Author</th>
									<th>Genre</th>
									<
									
									<th><i class="fa fa-cog"></i></th>
									<th><i class="fa fa-cog"></i></th>
								</tr>
							</thead>
							<tbody>
								@isset($audios)
			            		@foreach ($audios as $audio)
									<tr>
										@include('admin.edit-audio')
										<td>{{ $loop->index +1}}</td>
										<td>{{ $audio->name}}</td>
										<td>{{ $audio->description}}</td>
										<td>{{ $audio->year}}</td>
										<td>{{ $audio->author}}</td>
										<td>{{ $audio->genre->name}}</td>
										
										<td><a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#edit-audio{{$audio->id}}" title="Edit">Edit
                                			</a></td>
                                		<td><a class="btn btn-xs btn-danger" href="{{ route('audio.delete', $audio->id)}}" title="Delete?" onclick="return confirm('Are you sure about this ?')">Delete
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
<div class="modal fade" id="user-type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Upload Video</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('audio.type.add')}}" 
				>
					@csrf
					@isset($genre)
						<div class="form-group">
						<label for="exampleFormControlFile1"></label>
							<select name="types[]" class="form-control chosen-select" multiple>
				              <option value="basic" {{ in_array('basic', $genre->types) ? 'selected' : ''}}>Basic</option>
				              <option value="standard" {{ in_array('standard', $genre->types) ? 'selected' : ''}}>Standard</option>
				              <option value="premium" {{ in_array('premium', $genre->types) ? 'selected' : ''}}>Premium</option>
				            </select>
					</div>
					@else
					
					<div class="form-group">
						<label for="exampleFormControlFile1"></label>
							<select name="types[]" class="form-control chosen-select" multiple>
				              <option value="basic">Basic</option>
				              <option value="standard">Standard</option>
				              <option value="premium">Premium</option>
				            </select>
					</div>
					@endisset
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" id="submit-button" class="btn btn-primary">Save changes</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="add-genre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Sub Genre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('audio.genre.add')}}" 
       >
          @csrf
          <div class="form-group">
            <label for="exampleFormControlFile1">Name</label>
            <input type="text" class="form-control" id="exampleFormControlFile1" name="name" >
            @if ($errors->has('name'))
              <span class="text-danger">{{ $errors->first('name')}}</span>
            @endif
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
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Audio</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('audio.upload')}}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="form-group col-md-6">
							<label for="exampleFormControlFile1">Audio File</label>
							<input type="file" class="form-control" id="exampleFormControlFile1" name="audio"  accept="audio/*" required>
							@if ($errors->has('audio'))
								<span class="text-danger">{{ $errors->first('audio')}}</span>
							@endif
						</div>
						<div class="form-group col-md-6">
							<label for="exampleFormControlFile1">Name</label>
							<input type="text" class="form-control"  name="name" required>
						</div>
					</div>
					<div class="row">
							<div class="form-group col-md-6">
								<label for="exampleFormControlFile1">Author</label>
								<input type="text" class="form-control"  name="author" >
							
							</div>
						
							<div class="form-group col-md-6">
								<label for="exampleFormControlFile1">Year</label>
								<input type="text" class="form-control"  name="year" >
							
							</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
						<label for="exampleFormControlFile1">Description</label>
						<input type="text" class="form-control"  name="description" >
					
					</div>
					<div class="form-group col-md-6">
						<label for="exampleFormControlFile1">Genre</label>
						<select class="form-control chosen-select" name="genre_id">
							@isset($genres)
								@foreach ($genres as $g)
								<option value="{{ $g->id}}">{{ $g->name}}</option>
							@endforeach
							@endisset
						</select> 
					
					</div>
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






