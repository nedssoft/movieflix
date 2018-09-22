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
						<h2><i class="fa fa-briefcase"></i>Investments</h2>
							
						<div class="clearfix"></div>
					</div>
					<div>
						<a class="btn btn-md btn-primary upload-video" data-toggle="modal" data-target="#add-plan"> <i class="fa fa-plus"></i> Add Plan</a>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>S/No</th>
									<th>User</th>
									<th>Plan</th>
									<th>Amount</th>
									<th>Date</th>
									<th>Status</th>
									
									<th><i class="fa fa-cog"></i></th>
								</tr>
							</thead>
							<tbody>
								@isset($investments)
								@foreach ($investments as $inv)
									<tr>
										<td>{{ $loop->index +1}}</td>
										<td>{{ optional($inv->user)->username}}</td>
										<td>{{ $inv->category->name}}</td>
										<td>${{ number_format($inv->amount, 2)}}</td>
										<td>{{ $inv->created_at}}</td>
										<td>{{ $inv->status}}</td>
										<td><a class="btn btn-xs btn-danger" href="{{ route('delete.investment', $inv->id)}}" title="Delete?" onclick="return confirm('Are you sure you want to do this?')">Delete
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
<div class="modal fade" id="add-plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Plan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('admin.add.plan')}}">
					@csrf
					
					<div class="row">
						<div class="form-group col-md-6">
						<label for="exampleFormControlFile1">Name</label>
						<input type="text" name="name" required class="form-control">
						</div>
						<div class="form-group col-md-6">
							<label for="exampleFormControlFile1">Min Amount</label>
							<input type="number" class="form-control"  name="min_amount" required>
						
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
						<label for="exampleFormControlFile1">Max Amount</label>
						<input type="number" class="form-control"  name="max_amount" required>
					
						</div>
						<div class="form-group col-md-6">
							<label for="exampleFormControlFile1">ROI</label>
							<input type="text" class="form-control"  name="roi" required>
						
						</div>
				    </div>
					<div class="row">
						<div class="form-group col-md-6">
						<label for="exampleFormControlFile1">Weeks</label>
						<input type="number" class="form-control"  name="weeks" required>
						</div>
						<div class="form-group col-md-6">
							<label for="exampleFormControlFile1">Duration</label>
							<input type="number" class="form-control"  name="duration" required>
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
						<label for="exampleFormControlFile1">Type</label>
						<select name="type" required class="form-control">
							<option value="crypto">Crypto</option>
							<option value="nfp">NFP</option>
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
</div

@endsection






