
@extends('pages.component.header')
@section('content')


<div class="container mt-5">
    <!-- sucess message -->
    @if (Session::has('sucess'))
    <div class = "alert alert-success">
        {{Session::get('success')}}
    </div>
    @endif

    @if (count($errors) > 0)
        <div class="row">
            <div class="col-md-12 ">
                <div class="alert alert-danger">
                   <ul>
                      @foreach($errors->all() as $error)
                         <li>{{ $error }} </li>
                      @endforeach 
                   </ul> 
                </div>
            </div>
         </div>
    @endif

    <form method='post' action="{{ route('update.sku') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Upload File</label>
            <input type="file" class="form-control" id="sku_file" name="sku_file" value="">
        </div>
        <button type="submit" class="btn btn-success">Import SKU</button>
    </form>

</div>