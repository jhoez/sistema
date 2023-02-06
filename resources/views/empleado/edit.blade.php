@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible" role='alert'>
        {{ Session::get('mensaje') }}
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
    </div>
    @endif

<form action="{{ url('/empleado/'.$empleado->id) }}" method="post" enctype="multipart/form-data">
    @csrf <!-- Llave de seguridad que los datos son enviados del mismo sistema -->
    {{ method_field('PATCH') }} <!-- crear un input hidden con name='_method' y value='PATCH' -->
    @include('empleado.form',['tipo'=>'Actualizar'])
</form>

</div>
@endsection