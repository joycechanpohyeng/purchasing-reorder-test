@extends('welcome')
@section('content')

<div class="p-3 mx-auto" id = 'user-div'>
	<div class="align-items-center justify-content-center " >
		<div class="fixed-center">
			
			<div class="row ">
				<div class="col-lg-12 margin-tb">
					<div class="pull-left">
						<h4>Users Management</h4>
					</div>
					<div class="pull-right">
						@can('user-create')
						<a class="btn btn-success float-right" href="{{ route('users.create') }}"> Create New User</a>
						@endcan
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
							<th>No</th>
							<th>Name</th>
							<th>Employee ID</th>
							<th>Email</th>
							<th>Roles</th>
							<th width="100px">Action</th>
						</tr>
					</thead>
					</tbody>
						@foreach ($data as $key => $user)
						
							<tr>
								<!-- no column -->
								<td>{{ ++$i }}</td>
								
								<!-- name column -->
								<td>{{ $user->name }}</td>
								
								<!-- employee id column -->
								<td>{{ $user->employee_id }}</td>

								<!-- email column -->
								<td>{{ $user->email }}</td>

								<!-- roles column -->
								<td>
									@if(!empty($user->getRoleNames()))
										@foreach($user->getRoleNames() as $v)
											<label class="badge badge-pill badge-success">{{ $v }}</label>
										@endforeach
									@endif
								</td>
								<td>
									<a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
									
									@can('user-edit')
									<a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
									@endcan

									@can('user-delete')
									{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
										{!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick'=> "return confirm('Are you sure to remove user?')"]) !!}
									{!! Form::close() !!}

									@endcan
								</td>
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