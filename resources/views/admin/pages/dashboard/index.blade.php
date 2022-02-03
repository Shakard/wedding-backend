@extends('admin.master.master')

@section('title', 'Home')

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="row mtop16">
            <table class="table table-striped">
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
                <tbody style="color:#161616">
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
                                    <i style="color:#4f62fa" class="fa fa-download" aria-hidden="true"></i>
                                </a>
                                @can('book-edit')
                                <a href="{{ route('libros.edit', $libroLawyer->id) }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i style="color:#4f62fa" class="fa fa-edit" aria-hidden="true"></i></a>
                                @endcan
                                @can('book-delete')
                                <a href="{{ url('/admin/libro/'.$libroLawyer->id.'/destroy') }}" data-toggle="tooltip" data-placement="top" title="Excluir">
                                    <i style="color:#4f62fa" class="fa fa-trash-alt" aria-hidden="true"></i></a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection