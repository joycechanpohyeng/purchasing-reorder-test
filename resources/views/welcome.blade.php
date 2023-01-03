<!DOCTYPE html>
<html>
<head>
	<title> Purchasing Order </title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content = 'IE=edge'>
	
	<!-- Mobile device view -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>@yield('title')</title>

	<link rel = "stylesheet" href = "{{asset('css/app.css')}}">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>

<div class="container-fluid">
	<div class="fixed-top">
		<nav class = 'navbar navbar-light static-top' id="nav-header-container">
				
			<nav class='navbar'>
				<a class = "navbar-brand" href="/"><img src = "{{asset('/images/diy.png')}}" class="nav-logo"></a>
			</nav>
			<button class="navbar-toggler" id='toggler_home' type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon my-toggler"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo01" >
				<ul class="nav flex-column" id = "header_unorder_list">
					@guest
					<li class="nav-item " >
						<a class="nav-link" id = "header_unorder_list" href="{{ route('login') }}">Login</a>
					</li>
					<li class="nav-item" >
						<a class="nav-link" id = "header_unorder_list" href="{{ route('register') }}">Register</a>
					</li>
					<li class="nav-item" >
						<a class="nav-link" id = "header_unorder_list">Contact Us</a>
					</li>
					@else
					<li class="nav-item" >
						<a class = "nav-link active" href="{{route('dashboard')}}" active="request()->routeIs('dashboard')">Dashboard</a>
					</li>
					<li class="nav-item" >
						<a class="nav-link" id = "header_unorder_list" href= "{{route('profile.edit')}}">Profile</a>
					</li>
					<li class="nav-item" >
						<a class="nav-link" id = "header_unorder_list" href= "{{route('reorder.form')}}">Reorder Form</a>
					</li>

					@can('user-view', 'user-create', 'user-edit', 'user-delete')
					<li class="nav-item" >
						<a class="nav-link" id = "header_unorder_list" href = "{{ route('users.index') }}">Manage Users</a>
					</li>
					@endcan

					@can('role-view', 'role-create', 'role-edit', 'role-delete')
					<li class="nav-item" >
						<a class="nav-link" id = "header_unorder_list" href = "{{ route('roles.index') }}">Manage Role</a>
					</li>
					@endcan

					@can('product-view', 'product-create', 'product-edit', 'product-delete')
					<li class="nav-item" >
						<a class="nav-link" id = "header_unorder_list" href = "">Product List</a>
					</li>
					@endcan

					@can('product-create')
					<li class="nav-item" >
						<a class="nav-link" id = "header_unorder_list" href = "{{route('update.sku')}}">Update SKU</a>   {{--{{ route('products.index') }} --}}
					</li>
					@endcan

					<li class="nav-item" >
						<a class="nav-link" id = "header_unorder_list" href="{{ route('logout') }}">Logout</a>
					</li>
					@endguest
				</ul>
			</div>
		</nav>
	</div>
	<div class="content_view">
		@yield('content')
	</div>
</div>
</body>

</html>