<?php

namespace App\Http\Controllers;

use App\Models\DetalleConstruccion;
use Illuminate\Http\Request;

class DetalleConstruccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detalleconstruccion = new DetalleConstruccion;
        $detalleconstruccion->nombre = $request->get('nombre');
        $detalleconstruccion->estado = 1;
        $detalleconstruccion->idConstruccion = $request->get('construccion');
        $detalleconstruccion->save();

        return redirect()->route('construccion.show', $detalleconstruccion->idConstruccion);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetalleConstruccion  $detalleConstruccion
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleConstruccion $detalleConstruccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetalleConstruccion  $detalleConstruccion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalleconstruccion = DetalleConstruccion::findOrFail($id);

        return view('detalleconstruccion.edit',['detalleconstruccion'=>$detalleconstruccion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetalleConstruccion  $detalleConstruccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $detalleconstruccion = DetalleConstruccion::findOrFail($id);
        $detalleconstruccion->nombre = $request->get('nombre');
        $detalleconstruccion->update();

        return redirect()->route('construccion.show', $detalleconstruccion->idConstruccion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetalleConstruccion  $detalleConstruccion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detalleconstruccion = DetalleConstruccion::findOrFail($id);
        $detalleconstruccion->estado=0;
        $detalleconstruccion->update();
        


        return redirect()->route('construccion.show', $detalleconstruccion->idConstruccion);

    }
}
