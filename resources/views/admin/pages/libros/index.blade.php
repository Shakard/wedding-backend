@extends('admin.master.master')

@section('title', 'Livros')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a style="color:#4f62fa" href="{{url('/admin/libros')}}"><i class="fas fa-book" aria-hidden="true"></i> Documents</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="inside">
        <div class="mtop16">
            @include('admin.includes.alerts')
        </div>
        @can('book-create')
        <div class="btns">
            <a style="background-color:#02ccc6" href="{{ route('libros.create')}}" class="btn btn-info">
                <i class="fa fa-upload"></i> Upload Document
            </a>
        </div>
        @endcan

        @can('book-edit')
        <div class="col-md-12 mtop16">
            {!! Form::open(['route' => 'libros.search']) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fas fa-search"></i>
                    </span>
                </div>                
                {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => 'Enter some text']) !!}
                {!! Form::select('category', $cats, [ 'class' => 'form-control'], ['class' => 'form-control', 'placeholder' => 'Select a category']) !!}
                {!! Form::select('status', [ 'Pendiente' => 'Pendiente', 'Aprobado' => 'Aprobado', 'Rechazado' => 'Rechazado'], null, ['class' => 'form-control', 'placeholder' => 'Select a status']) !!}
                <button class="btn btn-info" type="submit" style="background-color:#02ccc6" id="button-addon3">Search</button>
            </div>
            {!! Form::close() !!}
        </div>          
        
        <table class="table table-striped mtop16">
            <thead style="color:#4f62fa">
                <tr>
                    <td>
                        <h5>Name</h5>
                    </td>
                    <td>
                        <h5>Detail</h5>
                    </td>
                    <td>
                        <h5>Category</h5>
                    </td>
                    <td>
                        <h5>Status</h5>
                    </td>
                    <td>
                        <h5>Comentary</h5>
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($libros as $libro)
                <tr>
                    <td>{{ $libro->name }}</td>
                    <td>{{ $libro->description }}</td>
                    <td>{{ $libro->category->name }}</td>
                    <td>{{ $libro->status }}</td>
                    <td>{{ $libro->coment }}</td>
                    <td width="250">
                        <div class="opts">
                            <a href="{{url('/admin/libros/download', $libro->file)}}">
                                <i style="color:#02ccc6" class="fa fa-download" aria-hidden="true"></i>
                            </a>
                            @can('book-edit')
                            <a href="{{ route('libros.edit', $libro->id) }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                <i style="color:#02ccc6" class="fa fa-edit" aria-hidden="true"></i></a>
                            @endcan    
                            @can('book-delete')    
                            <a href="{{ url('/admin/libro/'.$libro->id.'/destroy') }}" data-toggle="tooltip" data-placement="top" title="Excluir">
                                <i style="color:#02ccc6" class="fa fa-trash-alt" aria-hidden="true"></i></a>
                            @endcan    
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endcan  

        @can('product-list')
        <div class="col-md-12 mtop16">
            {!! Form::open(['route' => 'libros.searchLawyer']) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fas fa-search"></i>
                    </span>
                </div>                
                {!! Form::text('filter', null, ['class' => 'form-control', 'placeholder' => 'Enter some text', 'required']) !!}
                <button class="btn btn-info" type="submit" style="background-color:#02ccc6" id="button-addon3">Search</button>
            </div>
            {!! Form::close() !!}
        </div>          

        <div class="col-md-12 mtop16">
            {!! Form::open(['route' => 'libros.searchLawyerByCategory']) !!}
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                {!! Form::select('filter', $cats, [ 'class' => 'form-control'], ['class' => 'form-control', 'placeholder' => 'Select a category']) !!}
                <button class="btn btn-info" type="submit" style="background-color:#02ccc6" id="button-addon3">Buscar</button>
            </div>
            {!! Form::close() !!}
        </div>  

        <table class="table table-striped mtop16">
            <thead style="color:#4f62fa">
                <tr>
                    <td>
                        <h5>Name</h5>
                    </td>
                    <td>
                        <h5>Detail</h5>
                    </td>
                    <td>
                        <h5>Category</h5>
                    </td>
                    <td>
                        <h5>Status</h5>
                    </td>
                    <td>
                        <h5>Comentary</h5>
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($librosLawyer as $libroLawyer)
                <tr>
                    <td>{{ $libroLawyer->name }}</td>
                    <td>{{ $libroLawyer->description }}</td>
                    <td>{{ $libroLawyer->category->name }}</td>
                    <td>{{ $libroLawyer->status }}</td>
                    <td>{{ $libroLawyer->coment }}</td>
                    <td width="250">
                        <div class="opts">
                            <a href="{{url('/admin/libros/download', $libroLawyer->file)}}">
                                <i style="color:#02ccc6" class="fa fa-download" aria-hidden="true"></i>
                            </a>
                            @can('book-edit')
                            <a href="{{ route('libros.edit', $libroLawyer->id) }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                <i style="color:#02ccc6" class="fa fa-edit" aria-hidden="true"></i></a>
                            @endcan    
                            @can('book-delete')    
                            <a href="{{ url('/admin/libro/'.$libroLawyer->id.'/destroy') }}" data-toggle="tooltip" data-placement="top" title="Excluir">
                                <i style="color:#02ccc6" class="fa fa-trash-alt" aria-hidden="true"></i></a>
                            @endcan    
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endcan
    </div>
</div>
</div>
@endsection