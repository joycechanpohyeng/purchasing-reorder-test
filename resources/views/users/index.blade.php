@extends('layouts.app')
@section('content')

<div class="w-100 p-3 mx-auto bg-light">
	<div class="d-flex align-items-center justify-content-center " >
		<div class="fixed-center w-100">
			<div class="row">
				<div class="col-lg-12 margin-tb">
					<div class="pull-left">
						<h2>Users Management</h2>
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


			<table class="table table-bordered p-3 mt-3">
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Employee ID</th>
				<th>Email</th>
				<th>Roles</th>
				<th width="280px">Action</th>
			</tr>
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
								<label class="badge badge-success">{{ $v }}</label>
							@endforeach
						@endif
					</td>
					<td>
						<a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
						<a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
						@can('user-delete')
						{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
							{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
						{!! Form::close() !!}
						@endcan
					</td>
				</tr>
			@endforeach
			</table>

		</div>
	</div>
</div>
{!! $data->render() !!}



@endsection