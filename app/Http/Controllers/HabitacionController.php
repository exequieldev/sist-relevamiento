<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\DetalleHabitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $habitaciones=Habitacion::orderBy('idHabitacion','desc')->where('estado',1)->paginate(5);
        
        return view('habitacion.index', ['habitaciones'=>$habitaciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('habitacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:habitaciones'
        ],
        [
            'nombre.required' => 'Debe especificar un nombre de Habitación, no se admiten campos vacios.',
            'nombre.unique' => 'La Habitación que intenta ingresar ya existe.'
        ]
    
        );

        $habitacion = new Habitacion;
        $habitacion->nombre = $request->get('nombre');
        $habitacion->estado = 1;
        $habitacion->save();

        return redirect()->route('habitacion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $habitacion = Habitacion::findOrfail($id);
        $detalleHabitacion = DetalleHabitacion::orderBy('idDetalleHabitacion','desc')
        ->where('idHabitacion', $id)
        ->where('estado',1)
        ->paginate(5);

        return view('habitacion.show',['detalleHabitacion'=>$detalleHabitacion, 'idHabitacion' => $id,
        'nombre' => $habitacion->nombre]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $habitacion = Habitacion::findOrFail($id);

        return view('habitacion.edit',['habitacion'=>$habitacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required'
        ],
        [
            'nombre.required' => 'Debe especificar un nombre de Habitación, no se admiten campos vacios.'
        ]
    
        );

        $habitacion = Habitacion::findOrFail($id);
        $habitacion->nombre = $request->get('nombre');
        $habitacion->update();

        return redirect()->route('habitacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        $habitacion->estado=0;
        $habitacion->update();
        


        return redirect()->route('habitacion.index');
    }
}
