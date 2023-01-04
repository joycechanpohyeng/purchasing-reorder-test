@extends('welcome')
@section('content')

	   

<!-- Session Status -->
<div class="w-100 p-3" id="body-div">
	<div class="d-flex align-items-center justify-content-center " >
		<div class="row justify-content-center w-100">
			<div class="card shadow-5-strong" id = "card-form">
				<h5 class = 'card-header text-center'>Register</h5>
				<div class = 'card-body'>

					<form method="POST" action="{{ route('register') }}">
						@csrf

						<!-- Name -->
						<div class="form-group mb-3">
							<label for = 'name'>Name: </label>
							<input type='text' id='name' class = 'form-control' name="name" placeholder="" required autofocus>

							@if ($errors->has('name'))
							<span class = 'text-danger'>{{$errors->first('name')}}</span>
							@endif
						</div>

						<!-- Email -->
						<div class="form-group mb-3">
							<label for = 'email'>Email: </label>
							<input type='text' id='email' class = 'form-control' name="email" placeholder="" required autofocus>

							@if ($errors->has('email'))
							<span class = 'text-danger'>{{$errors->first('email')}}</span>
							@endif
						</div>

						<!-- Employee ID -->
						<div class="form-group mb-3">
							<label for = 'employee_id'>Employee ID: </label>
							<input type='text' id='employee_id' class = 'form-control' name="employee_id" placeholder="" required autofocus>

							@if ($errors->has('employee_id'))
							<span class = 'text-danger'>{{$errors->first('employee_id')}}</span>
							@endif
						</div>


						<!-- Password -->
						<div class="form-group mb-3">
							<label for = 'password'>Password: </label>
							<input type='password' id='password' class = 'form-control' name="password" placeholder="*****" required autocomplete="current-password">

							@if ($errors->has('password'))
							<span class = 'text-danger'>{{$errors->first('password')}}</span>
							@endif
						</div>

						<!-- Confirm Password -->
						<div class="form-group mb-3">
							<label for = 'password_confirmation'>Confirm Password: </label>
							<input type='password' id='password_confirmation' class = 'form-control' name="password_confirmation" placeholder="*****" required autocomplete="current-password">

							@if ($errors->has('password_confirmation'))
							<span class = 'text-danger'>{{$errors->first('password_confirmation')}}</span>
							@endif
						</div>

						<div class="flex items-center justify-end mt-4">
							<a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
								{{ __('Already registered?') }}
							</a>
							<div class="d-grid mx-auto">
								<button type = 'submit' class = "btn btn-dark btn-block">Sign In</button>
							</div>
							
						</div>		
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
