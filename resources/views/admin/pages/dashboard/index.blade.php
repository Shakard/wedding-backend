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
               
            </table>

        </div>
    </div>
</div>
@endsection