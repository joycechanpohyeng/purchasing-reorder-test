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
									@if(!is_null($order->generate_msg_at) || ($order->check == True))
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
									<!-- <img src = "{{ asset ('images/sku_images')}}/{{$order->file_name}}" class="w-20 rounded justify-content-center" > -->
									<img src = "{{ asset (''.$order->file_path)}}" class="sku-img" >
									<!-- <img src = "{{storage_path('app/public/uploads/1674004146_1.png')}}"> -->
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
									<a class="btn btn-info" href="{{route('reorder.show', $order->id)}}">Show</a>
									<a class="btn btn-info" href="">Edit</a>
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
					{!! Form::submit("Generate Message", ["type"=>"button", 
						"id" => "generateMsg", "class" => "btn btn-primary", "data-toggle"=>"modal", "data-target"=>"#modalLongReorder", 
						"data-attr" => "{{ route('reorder.store') }}"]) !!}

					<!-- {!! Form::submit("Generate Message", ["type"=>"button", 
						"id" => "generateMsg", "class" => "btn btn-primary"]) !!} -->
					
					<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalLongReorder">
						Generate Message
					</button> -->
					
					
					<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalLongReorder">
						View Message
					</button> -->

					<!-- modal -->
					<div class = "modal fade" id = "modalLongReorder" tabindex="-1" role="dialog" aria-labelledby="modalLongReorderTitle" aria-hidden="true">
						<div class="modal-dialog" role = "document">
							<div class = "modal-content">
								<div class = "modal-header">
									<h5 class="modal-title" id = "modalLongReorderTitle">Reorder Message</h5>
									<button type = "butthon" class = "close" data-dismiss="modal" aria-label = "Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class = "modal-body" id = "modal_body">
									...
								</div>
								<div class = "modal-footer">
									<button type = "button" class = "btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<script src = "{{asset('js/check_reorder_msg.js')}}"></script>
@endsection

