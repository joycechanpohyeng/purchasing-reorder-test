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

			{!! Form::open(['method' => 'POST','route' => ['reorder.store'],'style'=>'display:inline']) !!}
			<div class = 'tableContainer'>
				<table class="table table-striped table-bordered p-3 mt-3" id = 'user-table'>
					<thead>
						<tr>
							<th width="60px">Check</th>
							<th>Store Code</th>
							<th>SKU Code</th>
							<th width="60px">Picture</th>
							<th>M Group</th>
							<th>Order Quantity</th>
							<th>Current Balance</th>
							<th>Created At </th>
							<th>Message Generated At</th>
							<th width="40px">View Message</th>
						</tr>
					</thead>
					</tbody>
						@foreach ($data as $key => $order)
						
							<tr>
								<!-- check box -->
								<!-- <td>{{ ++$i }}</td> -->
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
								<td>{{ date('Y-m-d', strtotime($order->created_at))}}</td>

								<!-- message generate time column -->
								<td>{{ $order->generate_msg_at}}</td>

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
					<!-- <button type="submit" class="btn btn-primary" >Generate Message</button> -->
					<!-- <button type="submit" class="btn btn-primary" onclick="generate(data_len = '{{$i}}')">Generate Message</button> -->
					<!-- <button type="submit" class="btn btn-primary" href = "{{route('reorder.index')}}">Generate Message</button> -->
						{!! Form::submit('Generate Message', ['class' => 'btn btn-primary']) !!}
				</div>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<script src = "{{asset('js/check_reorder_msg.js')}}"></script>
@endsection

