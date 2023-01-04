@extends('welcome')
@section('content')



<div class="p-3 mx-auto" id = 'roles-div'>
	<div class="align-items-center justify-content-center " >
		<div class="fixed-center">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h4>Role Management</h4>
                    </div>
                    <div class="pull-right">
                        @can('role-create')
                        <a class="btn btn-success float-right" href="{{ route('roles.create') }}"> Create New Role</a>
                        @endcan
                    </div>
                </div>
            </div>


            @if ($message = Session::get('success'))
                <div class="alert alert-success p-3 mt-3">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class = 'tableContainer'>

                <table class="table table-striped table-bordered p-3 mt-3" id = "roles-table">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th width="100px">Action</th>
                </tr>
                    @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
                            @can('role-edit')
                                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
                            @endcan
                            @can('role-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick'=> "return confirm('Are you sure to remove user?')"]) !!}
                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </table>
                <div class="d-flex justify-content-left">
                    {!! $roles->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection