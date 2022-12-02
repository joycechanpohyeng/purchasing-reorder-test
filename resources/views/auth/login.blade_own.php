
@extends('dashboard')
@section('content')
<!-- <h1>Purchasing Order</h1> -->
<main class='login-form'>
    <div class ='container'>
        <div class="d-flex justify-content-center">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <h3 class = 'card-header text-center'>Login</h3>
                    <div class = 'card-body'>
                        <form method="POST" action="{{route('login.request')}}">

                            @csrf
                            <div class="form-group mb-3">
                                <label for = 'name'>Employee ID: </label>
                                <input type='text' id='employee_id' class = 'form-control' name="id" placeholder="ML12345" required autofocus>

                                @if ($errors->has('id'))
                                <span class = 'text-danger'>{{$errors->first('id')}}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for = 'name'>Password: </label>
                                <input type='password' id='password' class = 'form-control' name="password" placeholder="*****" required>

                                @if ($errors->has('password'))
                                <span class = 'text-danger'>{{$errors->first('password')}}</span>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <div class="checkbox">
                                    <label><input type="checkbox" name='remember'> Remember Me</label>
                                </div>
                            </div>

                            <div class="d-grid mx-auto">
                               <button type = 'submit' class = "btn btn-dark btn-block">Sign In</button>
                            </div>

                        </form>
                    </div>

                </div>
                
            </div>

        </div>
    </div>
</main>
@endsection