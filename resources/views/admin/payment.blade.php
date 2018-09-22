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
						<h2><i class="fa fa-briefcase"></i>Payments</h2>

						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
                                <tr>
									<th>S/No</th>
                                    <th>Payer</th>
                                    <th>Address Paid To</th>
								     <th>Amount</th>                                    
									<th>Coin</th>
								     <th>Status Text</th>
								     <th>Status</th>
								     <th>Createt At</th>
								     <th>Expires At</th>
								     {{-- <th>Confirmed At</th> --}}
								     <th>Action</th>	
								     <th></th>	
								</tr>
							</thead>
							<tbody>
								@isset($txs)
								@foreach ($txs as $tx)
								
								<tr>
									<td>{{$loop->index+1}}</td>
								    <td>{{ $tx->user->username}}</td>
								    <td>{{ $tx->payment_address}}</td>
									<td>{{$tx->amount}}</td>
									<td>{{$tx->coin}}</td>								
									<td>{{$tx->status_text}}</td>								
									<td>{{$tx->status}}</td>								
									<td>{{$tx->payment_created_at}}</td>								
									<td>{{$tx->payment_created_at}}</td>								
									{{-- <td>{{$tx->confirmation_at}}</td>	 --}}							
								
									@if ($tx->status !==100 && $tx->status !==200)								
                                		<td>
                                			<a class="btn btn-xs btn-primary" href="#" title="Confirm Transaction">Confrim
                                			</a>
                                		</td>
                                	@endif	
									<td><a class="btn btn-xs btn-danger" href="{{ route('delete.trx', $tx->id)}}" title="Delete?" onclick="return confirm('Are you sure you want to do this?')">Delete
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

@endsection




