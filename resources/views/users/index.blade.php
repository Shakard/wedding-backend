@extends('admin.master.master')

@section('title', 'Home')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a style="color:#4f62fa" href="{{url('/admin/users')}}"><i class="fa fa-folder-open" aria-hidden="true" ></i> Users</a>
    </li>
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
<table class="table table-striped">
  <tr style="color:#4f62fa">
    <th>Name</th>
    <th>Email</th>
    <th>Roles</th>
    <th width="280px"></th>
  </tr>
  @foreach ($data as $key => $user)
  <tr>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
      @foreach($user->getRoleNames() as $v)
      <label class="badge badge-success">{{ $v }}</label>
      @endforeach
      @endif
    </td>
    <td>
      <a class="btn btn-info" style="background-color:#02ccc6" href="{{ route('users.show',$user->id)}}"><i class="fa fa-window-maximize" aria-hidden="true"></i></a>
      <a class="btn btn-info" style="background-color:#02ccc6" href="{{ route('users.edit',$user->id)}}"><i class="fa fa-edit" aria-hidden="true"></i></a>
      {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
      {!! Form::submit('delete', ['class' => 'btn btn-info', 'style'=>"background-color:#02ccc6"]) !!}
      {!! Form::close() !!}
    </td>
  </tr>
  @endforeach
</table>
{!! $data->render() !!}
@endsection