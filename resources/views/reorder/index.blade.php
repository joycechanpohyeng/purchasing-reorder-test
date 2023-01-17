@extends('welcome')
@section('content')

<div class="p-3 mx-auto" id = 'user-div'>
	<div class="align-items-center justify-content-center " >
		<div class="fixed-center">
			
			<div class="row ">
				<div class="col-lg-12 margin-tb">
					<div class="pull-left">
						<h4>Pending Reorder Infor</h4>
					</div>
				</div>
			</div>


			@if ($message = Session::get('success'))
			<div class="alert alert-success p-3 mt-3">
				<p>{{ $message }}</p>
			</div>
			@endif

			<div class = 'tableContainer'>

			
				<table class="table table-striped table-bordered p-3 mt-3" id = 'user-table'>
					<thead>
						<tr>
							<th>Check</th>
							<th>Store Code</th>
							<th>SKU Code</th>
							<th>Picture</th>
							<th>M Group</th>
                            <th>Order Quantity</th>
                            <th>Current Balance</th>
                            <th>Message Generated At</th>
                            <th>View Message</th>
						</tr>
					</thead>
					</tbody>
						@foreach ($data as $key => $order)
						
							<tr>
								<!-- check box -->
								<td>{{ ++$i }}</td>
								
								<!-- store code column -->
								<td>{{ $order->store_code }}</td>
								
								<!-- sku code column -->
								<td>{{ $order->sku_code }}</td>

								<!-- show picture column -->
								<td>
                                    <a href = "#">
                                        <img src = "{{$order->file_path}}" class="w-20 rounded justify-content-center">
                                    </a>
                                </td>

                                <!-- m group column -->
								<td>{{ $order->m_group }}</td>

                                <!-- order quantity column -->
								<td>{{ $order->order_qty }}</td>

                                <!-- current balance column -->
								<td>{{ $order->remaining_qty }}</td>

                                <!-- message generate time column -->
								<td>{{ $order->generate_msg_at}}</td>

                                <!-- view message column -->
								<td>{{ $order->generate_msg_at}}</td>

								
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="d-flex justify-content-left">
					{!! $data->links() !!}
				</div>
			</div>
		</div>
	</div>
</div>


@endsection

