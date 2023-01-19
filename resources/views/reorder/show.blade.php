@extends('welcome')
@section('content')


<div class="p-3 mx-auto" id = 'user-div'>
	<div class="align-items-center justify-content-center " >
		<div class="fixed-center">
            
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2> Show Order details</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary float-right" href="{{ route('reorder.index') }}">Back</a>
                    </div>
                </div>
            </div>

            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Message Generated Time:</strong>
                        
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Supplier:</strong>
                        
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Store:</strong>
                        
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Roles:</strong>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection