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
							<th width="60px">Check</th>
							<th>Store Code</th>
							<th>SKU Code</th>
							<th width="60px">Picture</th>
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
								<!-- <td>{{ ++$i }}</td> -->
								<td>
									@if(!is_null($order->generate_msg_at))
										<label class="form-check-custom success with-icon">
											<input type = "radio" name = "message-check-box_{{$i}}" class="message-radio-success" id = 'tick_radio' value = 'false' disabled>
											<span><i class="fas fa-check">&#10003</i></span>
										</lable>
										<label class="form-check-custom danger with-icon">
											<input type = "radio" name = "message-check-box_{{$i}}" class="message-radio-danger" id = 'cross_radio' value = 'false' disabled>
											<span><i class="fas fa-check">&#x292B</i></span>
										</lable>
									@else
										<label class="form-check-custom success with-icon">
											<input type = "radio" name = "message-check-box_{{$i}}" class="message-radio-success" id = 'tick_radio'>
											<span><i class="fas fa-check">&#10003</i></span>
										</lable>
										<label class="form-check-custom danger with-icon">
											<input type = "radio" name = "message-check-box_{{$i}}" class="message-radio-danger" id = 'cross_radio'>
											<span><i class="fas fa-check">&#x292B</i></span>
										</lable>
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

								<!-- message generate time column -->
								@if ($i==1)
									<td>{{ $order->generate_msg_at}} {{$i}}</td>
								@else
									<td>{{ $order->generate_msg_at}}</td>
								@endif
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
			<div class="d-grid mx-auto" id = "gen-reorder-msg-button">
				<div class="col-md-12 text-center">
					<!-- <button type="submit" class="btn btn-primary" >Generate Message</button> -->
					<!-- <button type="submit" class="btn btn-primary" onclick="generate(data_len = '{{$i}}')">Generate Message</button> -->
					<button type="submit" class="btn btn-primary" href = "{{route('reorder.index')}}">Generate Message</button>
					
				
				</div>
			</div>
		</div>
	</div>
</div>

<script src = "{{asset('js/check_reorder_msg.js')}}"></script>
@endsection

