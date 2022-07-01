<?php

namespace App\Http\Controllers;

use App\Models\DetalleHabitacion;
use Illuminate\Http\Request;

class DetalleHabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nombre' => 'required|unique:detallehabitaciones'
        ],
        [
            'nombre.required' => 'Debe especificar un nombre de Detalle de Habitación, no se admiten campos vacios.',
            'nombre.unique' => 'El Detalle de Habitación que intenta ingresar ya existe.'
        ]
    
        );
        $detallehabitacion = new DetalleHabitacion;
        $detallehabitacion->nombre = $request->get('nombre');
        $detallehabitacion->estado = 1;
        $detallehabitacion->idHabitacion = $request->get('habitacion');
        $detallehabitacion->save();

        return redirect()->route('habitacion.show', $detallehabitacion->idHabitacion);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetalleHabitacion  $detalleHabitacion
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleHabitacion $detalleHabitacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetalleHabitacion  $detalleHabitacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detallehabitacion = DetalleHabitacion::findOrFail($id);

        return view('detallehabitacion.edit',['detallehabitacion'=>$detallehabitacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetalleHabitacion  $detalleHabitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required'
        ],
        [
            'nombre.required' => 'Debe especificar un nombre de Detalle de Habitación, no se admiten campos vacios.'
        ]
    
        );

        $detalleHabitacion = DetalleHabitacion::findOrFail($id);
        $detalleHabitacion->nombre = $request->get('nombre');
        $detalleHabitacion->update();

        return redirect()->route('habitacion.show', $detalleHabitacion->idHabitacion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetalleHabitacion  $detalleHabitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detallehabitacion = DetalleHabitacion::findOrFail($id);
        $detallehabitacion->estado=0;
        $detallehabitacion->update();
        


        return redirect()->route('habitacion.show', $detallehabitacion->idhabitacion);
    }
}
