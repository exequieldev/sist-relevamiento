<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MovimientoSocial;

class MovimientoSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movimientos=MovimientoSocial::orderBy('idMovimientoSocial','desc')->where('estado',1)->paginate(5);
        return view('movimiento.index', ['movimientos'=>$movimientos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movimiento.create');
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
            'nombre' => 'required|unique:movimientosociales'
        ],
        [
            'nombre.required' => 'Debe especificar un nombre del Mivimiento, no se admiten campos vacios.',
            'nombre.unique' => 'El Movimiento que intenta ingresar ya existe.'
        ]
    
        );
        $movimiento = new MovimientoSocial;
        $movimiento->nombre = $request->get('nombre');
        $movimiento->estado = 1;
        $movimiento->save();
        
        return redirect()->route('movimiento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movimiento = MovimientoSocial::findOrFail($id);

        return view('movimiento.edit',['movimiento'=>$movimiento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required'
        ],
        [
            'nombre.required' => 'Debe especificar un nombre del Movimiento, no se admiten campos vacios.',
        ]
        );

        $movimiento = MovimientoSocial::findOrFail($id);
        $movimiento->nombre = $request->get('nombre');
        $movimiento->update();

        return redirect()->route('movimiento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movimiento = MovimientoSocial::findOrFail($id);
        $movimiento->estado=0;
        $movimiento->update();
        


        return redirect()->route('movimiento.index');
    }
}
