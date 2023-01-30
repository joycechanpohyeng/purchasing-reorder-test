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

			{!! Form::open(['method' => 'POST', 'before' => 'csrf', 'route' => ['reorder.store'],'style'=>'display:inline']) !!}
			<div class = 'tableContainer'>
				<table class="table table-striped table-bordered p-3 mt-3" id = 'user-table'>
					<thead>
						<tr>
							<th width = "30px">Check</th>
							<th width = "30px">Store Code</th>
							<th width = "30px">SKU Code</th>
							<th width = "100px">Description</th>
							<th width = "60px">Picture</th>
							<th width = "30px">M Group</th>
							<th width = "30px">Order Quantity</th>
							<th width = "30px">Current Balance</th>
							<th width = "50px">Created At </th>
							<th width = "50px">Message Generated At</th>
							<th width = "40px">View Message</th>
						</tr>
					</thead>
					</tbody>
						@foreach ($data as $key => $order)
							<tr>
								<!-- check radio -->
								<td>
									@if(!is_null($order->generate_msg_at) || ($order->check == 1))
										{!! Form::radio("message-check-box_$order->id", true, true, ['id' => 'tick_radio', 'class' => "message-radio-success", 'disabled']) !!}
											<span><i class="fas fa-check">&#10003</i></span>
										{!! Form::radio("message-check-box_$order->id", false, null, ['id' => 'cross_radio', 'class' => "message-radio-danger", 'disabled']) !!}
											<span><i class="fas fa-check">&#x292B</i></span>
									@else
										{!! Form::radio("message-check-box_$order->id", true, null, ['id' => 'tick_radio', 'class' => "message-radio-success", 'style: co']) !!}
											<span><i class="fas fa-check">&#10003</i></span>
										{!! Form::radio("message-check-box_$order->id", false, true, ['id' => 'cross_radio', 'class' => "message-radio-danger"]) !!}
											<span><i class="fas fa-check">&#x292B</i></span>
									@endif
								</td>
								
								<!-- store code column -->
								<td>{{ $order->store_code }}</td>
								
								<!-- sku code column -->
								<td>{{ $order->sku_code }}</td>

								<!-- desc column -->
								<td>{{ $order->m_desc }}</td>

								<!-- show picture column -->
								<td>
									<img src = "{{ asset (''.$order->file_path)}}" class="sku-img" id = "skuImg">
									<!-- <img src = "{{ asset ('images/sku_images')}}/{{$order->file_name}}" class="w-20 rounded justify-content-center" > -->
									<div id = "imgModal" class="modal">
										<span class ="close">&times;</span>
										<img class = "modal-content" id = "modalImg">
										<div id = "caption"></div>
										<!-- <img src = "{{storage_path('app/public/uploads/1674004146_1.png')}}"> -->

									</div>
									
								</td>

								<!-- m group column -->
								<td>{{ $order->m_group }}</td>

								<!-- order quantity column -->
								<td>{{ $order->order_qty }}</td>

								<!-- current balance column -->
								<td>{{ $order->remaining_qty }}</td>

								<!-- current balance column -->
								<td>{{ date('Y-m-d h:i:s A', strtotime($order->created_at))}}</td>

								<!-- message generate time column -->
								@if (Empty($order->generate_msg_at))
									<td></td>
								@else
									<td>{{ date('Y-m-d h:i:s A', strtotime($order->generate_msg_at))}}</td>
								@endif
								
								<!-- view message column -->
								<td>
									@if(!Empty($order->generate_msg_at))
										<a class="btn btn-info" href="{{route('reorder.show', $order->id)}}">Show</a>
									@endif
									<!-- <a class="btn btn-info" href="">Edit</a> -->
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="d-flex justify-content-left">
					{!! $data->links() !!}
				</div>
			</div>

			<div class="d-grid mx-auto" id = "gen-reorder-msg-button">		
				
				<div class="col-md-12 text-center">
					
				<!-- {!! Form::open(['method' => 'POST','route' => ['reorder.store'],'style'=>'display:inline']) !!} -->
					{!! Form::submit('Generate Message', ['class' => 'btn btn-primary']) !!}
				<!-- {!! Form::close() !!} -->
					
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<script src = "{{asset('js/check_reorder_msg.js')}}">
	function showImage()
</script>
@endsection
