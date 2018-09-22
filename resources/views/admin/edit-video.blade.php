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
						<input type="file" class="form-control"  name="poster" required>
					
						</div>
						
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label for="exampleFormControlFile1">Description</label>
							<textarea class="form-control" rows="4"  name="description" required>{{$video->description}}</textarea>
						
						</div>
						<div class="form-group col-md-6">
							{{-- <label for="exampleFormControlFile1">ROI</label>
							<input type="text" class="form-control"  name="roi" required> --}}
						
						</div>
				    </div>
					{{-- <div class="row">
						<div class="form-group col-md-6">
						<label for="exampleFormControlFile1">Weeks</label>
						<input type="number" class="form-control"  name="weeks" required>
						</div>
						<div class="form-group col-md-6">
							<label for="exampleFormControlFile1">Duration</label>
							<input type="number" class="form-control"  name="duration" required>
						</div>
					</div> --}}
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