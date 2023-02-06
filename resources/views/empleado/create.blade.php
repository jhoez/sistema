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

<div class="row clearfix">
    <div class="col-md-offset-3 col-md-6">
        <form action="{{ url('/empleado') }}" method="post" enctype="multipart/form-data">
            @csrf <!-- Llave de seguridad que los datos son enviados del mismo sistema -->
            @include('empleado.form',['tipo'=>'Guardar'])
        </form>
    </div>
</div>

</div>
@endsection