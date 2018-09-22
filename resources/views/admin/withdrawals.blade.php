

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
						<h2><i class="fa fa-users"></i> Withdrawals</h2>

						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>S/No</th>
									<th>User</th>
									<th>Amount</th>
									<th>Status</th>
									<th>Source</th>
									{{-- <th>Withdrawal ID</th> --}}
									{{-- <th>Widthdrawal Status</th> --}}
									<th><i class="fa fa-cog"></i> Action</th>
									<th><i class="fa fa-cog"></i></th>
								</tr>
							</thead>
							<tbody>
								@isset($withdrawals)
								@foreach ($withdrawals as $w)
								<tr>
										<td>{{ $loop->index + 1}}</td>
										<td>{{ $w->user->username}}</td>
										<td>${{number_format($w->amount, 2)}}</td>
										<td>{{ title_case($w->status)}}</td>
										<td>{{ title_case($w->source)}}</td>
										{{-- <td>{{ $p->withdrawal_id}}</td> --}}
										{{-- <td>{{ $p->pay_status}}</td> --}}
										@if ($w->status == 'paid')
										<td><i class="fa fa-check"></i></td>
										@else
										<td><a href="{{route('withdrawal.pay', $w->id)}}" class="btn btn-xs btn-success" onclick="return confirm('Are you sure you want to pay this?')">Pay Now</a></td>
										@endif
										@if ($w->withdrawal_id && $w->status != 'paid')
										<td><a href="{{ route('confirm.withdrawal', $w->id)}}" class="btn btn-xs btn-success">Confirm</a></td>
										@else
										<td></td>
										@endif

										
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

@endsection














