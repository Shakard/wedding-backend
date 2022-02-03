@extends('admin.master.master')

@section('title', 'Novo Livro')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a style="color:#4f62fa" href="{{route('libros.index')}}"><i class="fas fa-book" aria-hidden="true"></i> Documents</a>
</li>
<li class="breadcrumb-item">
    <a style="color:#4f62fa" href="{{route('libros.create')}}"><i class="fas fa-book" aria-hidden="true"></i> Upload Document </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="inside">

            @include('admin.includes.alerts')

            {!! Form::open(['route' => 'libros.store', 'files' => true]) !!}
            <div class="row">
                <div class="col-md-4">
                    <label style="color:#4f62fa" for="name">Name:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i style="color:#02ccc6" class="fa fa-keyboard" aria-hidden="true"></i>
                            </span>
                        </div>
                        {!! Form::text('name', null, [ 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <label style="color:#4f62fa" for="category">Category:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basuc-addon1">
                                <i style="color:#02ccc6" class="fa fa-layer-group" aria-hidden="true"></i>
                            </span>
                        </div>
                        {!! Form::select('category', $cats, [ 'class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-8">
                    <br>
                </div>

                <div class="col-md-6">
                    <div class="input-group">
                        <div>
                            <input type="file" name="file">
                        </div>
                    </div>

                    <div class="row mtop16">
                        <div class="col-md-12">
                            <label style="color:#4f62fa" for="description">Descripción:</label>
                            <br>
                            <textarea id="description" name="description" rows="4" cols="50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>
                        </div>
                    </div>
                    <div class="row mtop16">
                        <div class="col-md-12">
                            {!! Form::submit('Upload', [ 'class' => 'btn btn-success', 'style'=>'background-color: #02ccc6' ]) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        @endsection