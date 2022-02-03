@extends('admin.master.master')

@section('title', 'Categorias')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a style="color:#4f62fa" href="{{url('/admin/categories/0')}}"><i class="fa fa-folder-open" aria-hidden="true"></i> Categories</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h3 class="title" style="color:#4f62fa"><i class="fa fa-plus" aria-hidden="true"></i> New Category</h3>
                </div>

                <div class="mtop16">
                    @include('admin.includes.alerts')
                </div>

                <div class="inside">
                    {!! Form::open(['route' => 'categories.store']) !!}
                    <label for="name" style="color:#4f62fa">Name:</label>
                    <div class="input-group" >
                        <div class="input-group-prepend" >
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa fa-keyboard" aria-hidden="true" style="color:#02ccc6"></i>
                            </span>
                        </div>
                        {!! Form::text('name', null, [ 'class' => 'form-control']) !!}
                    </div>

                    <label for="module" class="mtop16" style="color:#4f62fa">Module:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basuc-addon1">
                                <i class="fa fa-layer-group" aria-hidden="true" style="color:#02ccc6"></i>
                            </span>
                        </div>
                        {!! Form::select('module', ['0' => 'Libros'], 0, ['class' => 'custom-select']) !!}
                    </div>

                    <label for="description" class="mtop16" style="color:#4f62fa">Description:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basuc-addon1">
                                <i class="fa fa-keyboard" aria-hidden="true" style="color:#02ccc6"></i>
                            </span>
                        </div>
                        {!! Form::text('description', null, [ 'class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit('Create', [ 'class' => 'btn btn-success mtop16', 'style'=>'background-color:#02ccc6']) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>

        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h3 class="title" style="color:#4f62fa"><i class="fa fa-folder-open" aria-hidden="true"></i> Categories</h3>
                </div>

                <div class="inside">
                    <table class="table mtop16">
                        <thead>
                            <tr style="color:#4f62fa">
                                <td>Name</td>
                                <td>Description</td>
                                <td width="110"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cats as $cat)
                            <tr>
                                <td>{{$cat->name}}</td>
                                <td>{{$cat->description}}</td>
                                <td>
                                    <div class="opts">

                                        <a href="{{ route('categories.edit', $cat->id) }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                            <i style="color:#02ccc6" class="fa fa-edit" aria-hidden="true"></i></a>


                                        <a href="{{ url('/admin/category/'.$cat->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Excluir">
                                            <i style="color:#02ccc6" class="fa fa-trash-alt" aria-hidden="true"></i></a>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection