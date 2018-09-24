<div class="modal fade" id="edit-genre{{$genre->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Genre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('admin.genre.edit', $genre->id)}}" 
       >
          @csrf
          <div class="form-group">
            <label for="exampleFormControlFile1">Name</label>
            <input type="text" value="{{ $genre->name}}" class="form-control" id="exampleFormControlFile1" name="name" >
            @if ($errors->has('name'))
              <span class="text-danger">{{ $errors->first('name')}}</span>
            @endif
          </div>
        
          <div class="form-group">
            <label for="exampleFormControlFile1">User Types</label>
            <select name="types[]" multiple class="form-control chosen-select">
              <option value="basic" {{in_array('basic', (array)$genre->types) ? 'selected' : ''}}>Basic</option>
              <option value="standard" {{in_array('standard', (array)$genre->types) ? 'selected' : ''}}>Standard</option>
              <option value="premium" {{in_array('premium', (array)$genre->types) ? 'selected' : ''}}>Premium</option>
            </select>
          
          </div>
            {{--<div class="form-group">
            <label for="exampleFormControlFile1">Genre</label>
            <select class="form-control" name="genre_id">
              @foreach ($genres as $g)
              <option value="{{ $g->id}}">{{ $g->name}}</option>
              @endforeach
            </select> 
          
          </div> --}}
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="submit-button{{ $genre->id}}" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>