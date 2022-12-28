
@extends('welcome')
@section('content')

    @if ($message = Session::get('success'))
    <div class = 'alert alert-success p-3 mt-3'>
        <p>{{$message}}</p>
    </div>
    @endif

@endsection