@extends('layouts.app')

@section('content')
<div class="container">

<a href="{{ url('empleado/create') }}" class='btn btn-primary'>Registrar empleado</a>
<table class='table table-light'>
    <thead class='thead-light'>
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>
                    <img class='img-thumbnail img-fluid' src="{{ asset('storage').'/'.$data->foto }}" width='100' height='100' alt="">
                </td>
                <td>{{$data->nombre}}</td>
                <td>{{$data->apellidoPaterno}}</td>
                <td>{{$data->apellidoMaterno}}</td>
                <td>{{$data->correo}}</td>
                <td>
                    <a class='btn btn-warning' href="{{ url('/empleado/'.$data->id.'/edit') }}" >Editar</a>
                    <form class='d-inline' action="{{ url('/empleado/'.$data->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <input class='btn btn-danger' type="submit" value="Borrar" onclick="return confirm('¿Estas seguro de Borrar?')">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $empleados->links() !!}
</div>
@endsection