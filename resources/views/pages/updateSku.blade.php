

@extends('pages.component.header')
@section('content')

<main class ="update-sku-form">
	<div class="container d-flex justify-content-center">
        <div class="row justify-content-center">
            <div class = "card border-secondary mb-3" id = "sku-list-card">
            
                <h4 class="card-header text-center">Update SKU List</h4>
                <div class="card-body">
                    <!-- sucess message -->
                    @if ($message = Session::get('message'))
                        <div class="alert alert-success text-center">
                            <strong>{{ $message }}</strong>
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

                    <form method = 'POST' action="{{ route('update.sku') }}" enctype="multipart/form-data">
                        
                        @csrf
                        <div class="custom-file mb-3">
                                
                            
                            <input type="file" class="custom-file-input" id="sku_file" name="sku_file">
                            <label class="custom-file-label" for="file">Choose file</label>

                            @if ($errors->any('sku_file'))
                                <span class = "invalid-feedback" role="alert">
                                    <strong>
                                        {{$errors->first('sku_file')}}
                                    </strong>
                                </span>
                            @endif
                        </div>

                        <div class="d-grid mx-auto">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success">Import SKU</button>
                            </div>
                        </div>            
                    </form>    
                </div>
            </div>
        </div>
	</div>

</main>
@endsection