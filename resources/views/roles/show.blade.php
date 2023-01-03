@extends('welcome')
@section('content')


<div class="p-3 mx-auto" id = 'roles-div'>
	<div class="align-items-center justify-content-center " >
		<div class="fixed-center">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h4> Show Role</h4>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary float-right" href="{{ route('roles.index') }}"> Back</a>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $role->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permissions:</strong>
                        @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                                <label class="label label-success">{{ $v->name }},</label>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection