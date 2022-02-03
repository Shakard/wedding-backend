@extends('admin.master.master')

@section('title', 'Editar Documento')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a style="color:#4f62fa" href="{{url('admin/libros')}}"><i class="fas fa-book" aria-hidden="true"></i> Documents</a>
</li>
<li class="breadcrumb-item">
    <a style="color:#4f62fa" href=""><i class="fa fa-edit" aria-hidden="true"></i> Edit Document</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="panel shadow">
                <div class="inside">
                    @include('admin.includes.alerts')

                    {!! Form::open(['url' => '/admin/libros/'.$l->id.'/edit', 'files' => true]) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <label style="color:#4f62fa" for="name">Title:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i style="color:#02ccc6" class="fa fa-keyboard" aria-hidden="true"></i>
                                    </span>
                                </div>
                                {!! Form::text('name',$l->name, [ 'class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label style="color:#4f62fa"for="category">Category:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basuc-addon1">
                                        <i style="color:#02ccc6" class="fa fa-layer-group" aria-hidden="true"></i>
                                    </span>
                                </div>
                                {!! Form::select('category', $cats, $l->category->id, ['class' => 'custom-select']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label style="color:#4f62fa" for="status">Status:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basuc-addon2">
                                        <i style="color:#02ccc6"class="fa fa-layer-group" aria-hidden="true"></i>
                                    </span>
                                </div>
                                {!! Form::select('status', ['Aprobado' => 'Aprobado', 'Rechazado' => 'Rechazado'], null, ['class' => 'form-control', 'placeholder' => 'Seleccione un estado', 'required']) !!}
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-8">
                           <br>
                        </div> 
                        <div class="col-md-8">
                            <div class="col-md-12">
                                <label style="color:#4f62fa"for="description">Description:</label>
                                <br>
                                {!! Form::textarea('description', $l->description, ['id' => 'description', 'rows' => 2, 'cols' => 30, 'style' => 'resize:auto']) !!}
                            <br>
                            <br>
                            </div>
                        </div> 

                        <div class="col-md-8">
                            <div class="col-md-12">
                                <label style="color:#4f62fa"for="coment">Comentary:</label>
                                <br>
                                {!! Form::textarea('coment', $l->coment, ['id' => 'coment', 'rows' => 2, 'cols' => 30, 'style' => 'resize:none']) !!}
                                <br>
                                <br>
                            </div>
                        </div>  
                        <div class="col-md-8">
                            <div class="col-md-12">
                                {!! Form::submit('Save changes', [ 'class' => 'btn btn-success', 'style'=>'background-color:#02ccc6']) !!}
                            </div>
                        </div>   
                        </div>            

                        
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection