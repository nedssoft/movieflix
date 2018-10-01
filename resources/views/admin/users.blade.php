
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
						<h2><i class="fa fa-users"></i> List Of Users</h2>

						<div class="clearfix"></div>
					</div>
					<div>
						<a class="btn btn-md btn-primary upload-video" data-toggle="modal" data-target="#add-users" data-keyboard="false" data-backdrop="static"> <i class="fa fa-plus"></i> Create New User</a>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>S/No</th>
									<th>Username</th>
									<th>Type</th>
									<th>Date</th>
									 <th><i class="fa fa-edit"></i></th>
                  					<th><i class="fa fa-trash"></i></th>
								</tr>
							</thead>
							<tbody>
								@isset($users)
									@foreach($users as $user)
										<tr>
										<td>{{ $loop->index +1}}</td>
										<td>{{$user->username}}</td>
										<td>{{$user->type}}</td>
										<td>{{$user->created_at}}</td>
										
										<td><a class="btn btn-xs btn-primary" data-toggle="modal" data-target="#edit-user{{$user->id}}"title="Edit">Edit
                                      </a></td>
										<td><a href="{{route('user.delete', $user->id)}}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to do this?')">Delete User</a></td>	
										</tr>
										@include('admin.edit-user')
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
<div class="modal fade" id="add-users" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('user.add')}}">
					@csrf
					
					
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select class="form-control chosen-select" name="type">
                                	<option value="basic">Basic</option>
                                	<option value="standard">Standard</option>
                                	<option value="premium">Premium</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
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
		
			@if ($errors->any())
				$('#add-users').modal('show');
			@endif

			$('#add-users').on('show.bs.modal', function(e){
			
				$(e.currentTarget).find('#submit-button').click(function(e){
					
					$(this).html('<i class="fa fa-spinner fa-spin"></i>');
				});
			});

		</script>

	@endpush
@endsection









