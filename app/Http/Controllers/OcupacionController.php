<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ocupacion;

class OcupacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ocupaciones = Ocupacion::orderBy('idOcupacion','desc')->where('estado',1)->paginate(5);

        return view('ocupacion.index', ['ocupaciones'=>$ocupaciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ocupacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ocupacion = new Ocupacion;
        $ocupacion->nombre = $request->get('nombre');
        $ocupacion->estado = 1;
        $ocupacion->save();

        return redirect()->route('ocupacion.index');
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
        $ocupacion = Ocupacion::findOrFail($id);

        return view('ocupacion.edit',['ocupacion'=>$ocupacion]);
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
        $ocupacion = Ocupacion::findOrFail($id);
        $ocupacion->nombre = $request->get('nombre');
        $ocupacion->update();

        return redirect()->route('ocupacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ocupacion = Ocupacion::findOrFail($id);
        $ocupacion->estado=0;
        $ocupacion->update();

        return redirect()->route('ocupacion.index');
    }
}
