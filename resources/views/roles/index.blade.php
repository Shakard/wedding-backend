@extends('admin.master.master')

@section('title', 'Roles')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a style="color:#4f62fa" href="{{url('/admin/roles')}}"><i class="fa fa-folder-open" aria-hidden="true" ></i> Users</a>
    </li>
@endsection

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-right">
        @can('role-create')
            <a style="background-color:#02ccc6" class="btn btn-info" href="{{ route('roles.create') }}"> Create New Role</a>
        @endcan
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<table class="table table-bordered">
  <tr style="color:#4f62fa">
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $key => $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}" style="background-color:#02ccc6">Show</a>
            @can('role-edit')
                <a class="btn btn-info" href="{{ route('roles.edit',$role->id) }}" style="background-color:#02ccc6">Edit</a>
            @endcan
            @can('role-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-info', 'style'=>'background-color:#02ccc6']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>
{!! $roles->render() !!}
@endsection