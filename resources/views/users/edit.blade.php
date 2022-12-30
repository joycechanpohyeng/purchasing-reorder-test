@extends('welcome')
@section('content')

<div class="p-3 mx-auto" id = 'user-div'>
	<div class="align-items-center justify-content-center " >
		<div class="fixed-center">
			<div class="row">
				<div class="col-lg-12 margin-tb">
					<div class="pull-left">
						<h2>Edit New User</h2>
					</div>
					<div class="pull-right">
						<a class="btn btn-primary float-right" href="{{ route('users.index') }}"> Back</a>
					</div>
				</div>
			</div>


			@if (count($errors) > 0)
			<div class="alert alert-danger">
				<!-- <strong>Whoops!</strong> There were some problems with your input.<br><br> -->
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
				</ul>
			</div>
			@endif


			{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Name:</strong>
						{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class = "form-group">
						<strong>Employee ID:</strong>
						{!! Form::text('employee_id', null, array('placeholder'=> 'employee_id', 'class' => 'form-control')) !!}
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Email:</strong>
						{!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
					</div>
				</div>
				@can('user-delete')
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Password:</strong>
						{!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<strong>Confirm Password:</strong>
						{!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
					</div>
				</div>
				@endcan
				<div class="col-xs-12 col-sm-12 col-md-12">
					
					<div class="form-group">
						<strong>Role:</strong>
						<!-- {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!} -->
						{!! Form::select("roles[]", [''] + $roles, null,array('class' => 'form-control')) !!}

						<!-- <div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="inputGroupSelect01">Options</label>
							</div>
							<select class = 'custom-select' id = 'inputGroupSelect01'>
								<option selected> Select...</option>
								<option value = "Admin">Admin</option>
								<option value = "Purchaser">Purchaser</option>
								<option value = "Manager">Manager</option>
								<option value = "User">User</option>
							</select>
						</div> -->


					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 text-center">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}

@endsection