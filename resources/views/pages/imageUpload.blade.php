

@extends('pages.component.header')
@section('content')


<div class=" p-3 mx-auto bg-light">
	<div class="container d-flex justify-content-center">
        <div class="row justify-content-center">
            <div class = "card border-secondary mb-3" id = 'reorder-card'>
            
                <h4 class="card-header text-center">Reorder Form</h4>
                <div class="card-body">
                    @if (Session::has('success'))
                        <div class = "alert alert-success test-center">
                            {{session::get('success')}}
                        </div>
                    @endif

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success text-center">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif

                    <form method = 'POST' action = "{{route('reorder.form')}}" enctype="multipart/form-data">
                        
                        @csrf
                        <!-- store-->
                        <div class="form-group mb-3">
                            <label class="form-label" for = 'store_code'>Store</label>
                            <input type='text' name="store_code" id='store_code' class = " form-control @error('store_code') is-invalid @enderror">

                            @if ($errors->any('store_code'))
                            <span class = "invalid-feedback" role="alert">
                                <strong>
                                    {{$errors->first('store_code')}}
                                </strong>
                            </span>
                            @endif
                        </div>

                        <!-- change to dropdown select search for sku_code-->
                        <div class="form-group mb-3">
                            <label class="form-label" for ='sku_code'>SKU Code</label>
                            <input type='text' name="sku_code" id='sku_code' class = "typeahead form-control @error('sku_code') is-invalid @enderror">
                            
                            @if ($errors->any('sku_code'))
                            <span class = "invalid-feedback" role="alert">
                                <strong>
                                    {{$errors->first('sku_code')}}
                                </strong>
                            </span>
                            @endif
                        </div>

                        <script type="text/javascript">
                            var route = "{{ route('search.sku.form') }}";
                            $('#sku_code').typeahead({
                                source: function (query, process) {
                                    return $.get(route, {query: query}, function (data) {return process(data);});
                                }
                            });
                        </script>

                        
                        <!-- order quantity -->
                        <div class="form-group mb-3">
                            <label class="form-label" for ='order_qty'>Order Quantity</label>
                            <input type='number' name="order_qty" id='order_qty' class = " form-control @error('order_qty') is-invalid @enderror">

                            @if ($errors->any('order_qty'))
                            <span class = "invalid-feedback" role="alert">
                                <strong>
                                    {{$errors->first('order_qty')}}
                                </strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for = 'remaining_qty'>Remaining Quantity</label>
                            <input type='number' name="remaining_qty" id='remaining_qty' class = " form-control @error('remaining_qty') is-invalid @enderror">

                            @if ($errors->any('remaining_qty'))
                            <span class = "invalid-feedback" role="alert">
                                <strong>
                                    {{$errors->first('remaining_qty')}}
                                </strong>
                            </span>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="inputImage">Upload Image</label>
                            <input type="file" name="image" id="inputImage" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-grid mx-auto">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                        
                    </form>    
                </div>
            </div>
        </div>
	</div>
</div>
   

    <script type = "text/javascript">
        var route = "{{url('search-store_code')}}";
        $('#store_code').typeahead({
            source: function(query, process){
                return $.get(route, {query:query}, function(data) {return process(data)});
            }
        });
    </script>


@endsection