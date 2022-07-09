<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nivel;

class NivelController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $niveles = Nivel::orderBy('idNivel','desc')->where('estado',1)->paginate(5);

        return view('nivel.index', ['niveles'=>$niveles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nivel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nivel = new Nivel;
        $nivel->nombre = $request->get('nombre');
        $nivel->estado = 1;
        $nivel->save();

        return redirect()->route('nivel.index');
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
        $nivel = Nivel::findOrFail($id);

        return view('nivel.edit',['nivel'=>$nivel]);
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
        $nivel = Nivel::findOrFail($id);
        $nivel->nombre = $request->get('nombre');
        $nivel->update();

        return redirect()->route('nivel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nivel = Nivel::findOrFail($id);
        $nivel->estado=0;
        $nivel->update();

        return redirect()->route('nivel.index');
    }
}
