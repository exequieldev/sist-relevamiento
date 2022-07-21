<?php

namespace App\Http\Controllers;

use App\Models\Manzana;
use App\Models\Barrio;
use App\Models\BarriosManzana;

use DB;
use Illuminate\Http\Request;

class ManzanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$manzanas=Manzana::orderBy('idManzana','desc')->where('estado',1)->paginate(5);
        $manzanas=BarriosManzana::orderBy('idBarrio_Manzanas','desc')
        ->join('barrios','barrio_manzanas.idBarrio','=','barrios.idBarrio')
        ->join('manzanas','barrio_manzanas.idManzana','=','manzanas.idManzana')
        ->select('barrio_manzanas.idBarrio_Manzanas as numeracion','barrios.nombre as barrio','manzanas.numero','manzanas.division')
        ->paginate(5);
        //dd($manzanas);
        return view('manzana.index', ['manzanas'=>$manzanas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barrios = Barrio::all();
        return view('manzana.create',compact('barrios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $manzana = new Manzana;
        $manzana->numero = $request->get('numeroManzana');
        $manzana->division = $request->get('divisionManzana');
        $manzana->estado = 1;
        $manzana->save();

        $barrioManzana = new BarriosManzana;
        $barrioManzana->idBarrio = $request->get('barrios');
        $barrioManzana->idManzana = $manzana->idManzana;
        $barrioManzana->save();

        return redirect()->route('manzana.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manzana  $manzana
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manzana = Manzana::findOrFail($id);

        return view('manzana.show',['manzana'=>$manzana]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manzana  $manzana
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manzana = Manzana::findOrFail($id);

        return view('manzana.edit',['manzana'=>$manzana]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manzana  $manzana
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $manzana = Manzana::findOrFail($id);
        $manzana->descripcion = $request->get('descripcion');
        $manzana->update();

        return redirect()->route('manzana.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manzana  $manzana
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manzana = Manzana::findOrFail($id);
        $manzana->estado=0;
        $manzana->update();

        return redirect()->route('manzana.index');
    }
}
