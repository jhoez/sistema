<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result['empleados'] = Empleado::paginate(5);
        return view('empleado.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos = [
            'nombre'=>'required|string|max:100',
            'apellidoPaterno'=>'required|string|max:100',
            'apellidoMaterno'=>'required|string|max:100',
            'correo'=>'required|email',
            'foto'=>'required|max:10000|mimes:jpeg,jpg,png',
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido!!',
            'foto.required'=>'La foto es requerida',
        ];
        $this->validate($request,$campos,$mensaje);

        //$datosEmpleados = $request->all();
        $datosEmpleados = $request->except('_token');

        if ($request->hasFile('foto')) {
            $datosEmpleados['foto'] = $request->file('foto')->store('uploadFotos','public');
            $datosEmpleados['created_at'] = date('Y-m-d h:i:s',time());
            //$datosEmpleados['updated_at'] = date('Y-m-d h:i:s',time());
        }

        // insertar en base de datos
        Empleado::insert($datosEmpleados);

        //return Response()->json($datosEmpleados);
        return redirect('empleado/create')->with('mensaje','Empleado agregado con exito!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        //
        $empleado['empleado'] = Empleado::findOrFail($empleado->id);
        return view('empleado.edit',$empleado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        //
        $campos = [
            'nombre'=>'required|string|max:100',
            'apellidoPaterno'=>'required|string|max:100',
            'apellidoMaterno'=>'required|string|max:100',
            'correo'=>'required|email',
        ];
        $mensaje = [
            'required'=>'El :attribute es requerido!!',
        ];
        if ( $request->hasFile('foto') ) {
            $campos = ['foto'=>'required|max:10000|mimes:jpeg,jpg,png'];
            $mensaje = ['foto.required'=>'La foto es requerida'];
        }
        $this->validate($request,$campos,$mensaje);

        $datosEmpleados = $request->except(['_token','_method']);
        if ($request->hasFile('foto')) {
            $empleado = Empleado::findOrFail($empleado->id);
            Storage::delete('public/'.$empleado->foto);
            $datosEmpleados['foto'] = $request->file('foto')->store('uploadFotos','public');
            $datosEmpleados['updated_at'] = date('Y-m-d h:i:s',time());
        }
        Empleado::where('id','=',$empleado->id)->update($datosEmpleados);

        $empleado['empleado'] = Empleado::findOrFail($empleado->id);
        return redirect('empleado')->with('mensaje','El Empleado ha sido actualizado!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        //
        $empleado = Empleado::findOrFail($empleado->id);
        if ( Storage::delete('public/'.$empleado->foto) ) {
            Empleado::destroy($empleado->id);
        }
        return redirect('empleado')->with('mensaje','El Empleado ha sido borrado!!');
    }
}
