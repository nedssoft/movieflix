@extends('layouts.admin.app')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">  
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="min-height: 530px">
          <div class="x_title">
            <h2><i class="fa fa-plus"></i> <a class="btn btn-md btn-primary upload-video" data-toggle="modal" data-target="#add-genre">Add Genre</a></h2>

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>S/No</th>
                  <th>Name</th>
                  <th>User Types</th>
                  <th>Date</th>
                
                  <th><i class="fa fa-edit"></i></th>
                  <th><i class="fa fa-trash"></i></th>
                </tr>
              </thead>
              <tbody>
                @isset($genres)
                      @foreach ($genres as $genre)
                        
                  <tr>
                    <td>{{ $loop->index +1}}</td>
                    <td>{{ $genre->name}}</td>
                    <td>
                     @isset($genre->types)
                       @foreach ( (array)$genre->types as $type)
                        {{ title_case($type)}}
                        @unless ($loop->last)
                        ,
                        @endunless
                      @endforeach
                     @endisset
                    </td>
                    <td>{{ $genre->created_at}}</td>
                   
                    <td><a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#edit-genre{{$genre->id}}"title="Edit">Edit
                                      </a></td>
                                    <td><a class="btn btn-xs btn-danger" href="{{ route('genre.delete', $genre->id)}}" title="Delete?" onclick="return confirm('Are you sure about this ?')">Delete
                                      </a></td>
                  </tr>
                  @include('admin.edit-genre');
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
 <div class="modal fade" id="add-genre" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Genre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('admin.genre.add')}}" 
       >
          @csrf
          <div class="form-group">
            <label for="exampleFormControlFile1">Name</label>
            <input type="text" class="form-control" id="exampleFormControlFile1" name="name" >
            @if ($errors->has('name'))
              <span class="text-danger">{{ $errors->first('name')}}</span>
            @endif
          </div>
        
          <div class="form-group">
            <label for="exampleFormControlFile1">User Types</label>
            <select name="types[]" multiple class="form-control chosen-select">
              <option value="basic">Basic</option>
              <option value="standard">Standard</option>
              <option value="premium">Premium</option>
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






