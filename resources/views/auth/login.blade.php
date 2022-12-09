{{-- 
@extends('welcome')
@section('content') --}}

       

<!-- Session Status -->

<main class='login-form'>
    <div class ='container'>
        <div class="d-flex justify-content-center">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <h3 class = 'card-header text-center'>Login</h3>
                    <div class = 'card-body'>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group mb-3">
                                <label for = 'email'>Email: </label>
                                <input type='text' id='email' class = 'form-control' name="email" placeholder="ML12345" required autofocus>

                                @if ($errors->has('email'))
                                <span class = 'text-danger'>{{$errors->first('email')}}</span>
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

                            <!-- Remember Me -->
                            <div class="block mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                @if (Route::current()->getName()=='password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif

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
</main>
