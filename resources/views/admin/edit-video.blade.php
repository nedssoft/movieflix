<div class="modal fade" id="edit-video{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Movie</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('admin.edit.video', $video->id)}}" enctype="multipart/form-data">
					@csrf
					
					<div class="row">
						<div class="form-group col-md-6">
						<label for="exampleFormControlFile1">Title</label>
						<input type="text" name="title" value="{{ $video->title}}" required class="form-control">
						</div>
						<div class="form-group col-md-6">
						<label for="exampleFormControlFile1">Poster</label>
						<input type="file" class="form-control"  name="poster">
					
						</div>
						
					</div>
					<div class="row">
						<div class="form-group col-md-6">
						<label for="rating">Rating</label>
						 <select class="form-control chosen-select" name="rating">
						 	<option value="">Select...</option>
						 	<option value="Generel - (G)">Generel - (G)</option>
						 	<option value="PG – Parental guidance">PG – Parental guidance</option>
						 	<option value="PG-13">PG-13</option>
						 	<option value="R - Restricted">R - Restricted</option>
						 	<option value="NC-17 (No-one under 17)">NC-17 (No-one under 17)</option>
						 	<option value="Unrated">Unrated</option>
						 </select>
						</div>
						<div class="form-group col-md-6">
							<label for="year">Year</label>
							<input type="text" class="form-control" value="{{$video->year}}" name="year">
						
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="exampleFormControlFile1">Description</label>
							<textarea class="form-control" rows="4"  name="description" required>{{$video->description}}</textarea>
						
						</div>
						<div class="form-group col-md-6">
							<label for="exampleFormControlFile1">Casts</label>
							<textarea class="form-control" rows="4"  name="casts" required>{{$video->casts}}</textarea>
						</div>
						
				    </div>
					
					{{-- <div class="row">
						<div class="form-group col-md-6">
						<label for="exampleFormControlFile1">Type</label>
						<select name="type" required class="form-control">
							<option value="crypto">Crypto</option>
							<option value="nfp">NFP</option>
						</select>
					</div>
					</div> --}}
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" id="submit-button" class="btn btn-primary">Save changes</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>