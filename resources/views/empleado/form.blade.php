    @if( count($errors) > 0 )
    <div class="alert alert-danger">
        <ul>
        @foreach( $errors->all() as $error )
            <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name='nombre' value="{{ isset($empleado->nombre)? $empleado->nombre: old('nombre') }}" placeholder="Nombre">
    </div>
    <div class="form-group">
        <label for="apellidoPaterno">Apellido Paterno</label>
        <input type="text" class="form-control" id="apellidoPaterno" name='apellidoPaterno' value="{{ isset($empleado->apellidoPaterno)? $empleado->apellidoPaterno : old('apellidoPaterno') }}" placeholder="Apellido Paterno">
    </div>
    <div class="form-group">
        <label for="apellidoMaterno">Apellido Materno</label>
        <input type="text" class="form-control" id="apellidoMaterno" name='apellidoMaterno' value="{{ isset($empleado->apellidoMaterno)? $empleado->apellidoPaterno : old('apellidoMaterno') }}" placeholder="Apellido Materno">
    </div>
    <div class="form-group">
        <label for="correo">Correo</label>
        <input type="email" class="form-control" id="correo" name='correo' value="{{ isset($empleado->correo)? $empleado->correo : old('correo') }}" placeholder="Email">
    </div>
    <div class="form-group">
        @if(isset($empleado->foto))
            <img class='img-thumbnail img-fluid' src="{{ asset('storage').'/'.$empleado->foto }}" width='200' height='200' alt="">
        @endif
        <label for="foto">Foto</label>
        <input type="file" class="form-control" id="foto" name='foto'>
    </div>
    <div class="form-group">
        <input class='btn btn-success' type="submit" value="{{$tipo}} datos">
        <a class='btn btn-primary' href="{{ url('empleado') }}">Regresar</a>
    </div>