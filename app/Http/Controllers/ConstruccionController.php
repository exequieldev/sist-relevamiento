<?php

namespace App\Http\Controllers;

use App\Models\Construccion;
use Illuminate\Http\Request;
use App\Models\DetalleConstruccion;
class ConstruccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $construcciones =Construccion::orderBy('idConstruccion','desc')->where('estado',1)->paginate(5);
       return view('construccion.index', ['construcciones'=>$construcciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('construccion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $construccion = new Construccion;
        $construccion->nombre = $request->get('nombre');
        $construccion->estado = 1;
        $construccion->save();

        return redirect()->route('construccion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Construccion  $construccion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $construccion = Construccion::findOrfail($id);
        $detalleconstruccion =DetalleConstruccion::orderBy('idDetalleConstruccion','desc')
        ->where('idConstruccion', $id)
        ->where('estado',1)
        ->paginate(5);

        return view('construccion.show',['detalleconstruccion'=>$detalleconstruccion, 'idConstruccion' => $id,
        'nombre' => $construccion->nombre]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Construccion  $construccion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $construccion = Construccion::findOrFail($id);

        return view('construccion.edit',['construccion'=>$construccion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Construccion  $construccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $construccion = Construccion::findOrFail($id);
        $construccion->nombre = $request->get('nombre');
        $construccion->update();

        return redirect()->route('construccion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Construccion  $construccion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $construccion = Construccion::findOrFail($id);
        $construccion->estado=0;
        $construccion->update();
        


        return redirect()->route('construccion.index');
    }
}
