<div class="modal fade" id="edit-audio{{$audio->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Audio</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('audio.edit', $audio->id)}}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="form-group col-md-6">
							<label for="exampleFormControlFile1">Poster</label>
							<input type="file" class="form-control"  name="poster">
						
						</div>
						
						<div class="form-group col-md-6">
							<label for="exampleFormControlFile1">Name</label>
							<input type="text" class="form-control"  name="name" value="{{$audio->name}}" required>
						</div>
					</div>
					<div class="row">
							<div class="form-group col-md-6">
								<label for="exampleFormControlFile1">Author</label>
								<input type="text" class="form-control"  name="author" value="{{$audio->author}}" >
							
							</div>
						
							<div class="form-group col-md-6">
								<label for="exampleFormControlFile1">Year</label>
								<input type="text" class="form-control"  name="year" value="{{$audio->year}}">
							
							</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
						<label for="exampleFormControlFile1">Description</label>
						<input type="text" class="form-control"  name="description" value="{{$audio->description}}">
					
					</div>
					<div class="form-group col-md-6">
						<label for="exampleFormControlFile1">Genre</label>
						<select class="form-control chosen-select" name="genre_id">
							@isset($genres)
								@foreach ($genres as $g)
								<option value="{{ $g->id}}" {{$audio->genre->id === $g->id ? 'selected' :''}}>{{ $g->name}}</option>
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