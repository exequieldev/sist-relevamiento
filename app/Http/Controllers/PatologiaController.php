<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patologia;

class PatologiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patologias = Patologia::orderBy('idPatologia','desc')->where('estado',1)->paginate(5);

        return view('patologia.index', ['patologias'=>$patologias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patologia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patologia = new Patologia;
        $patologia->nombre = $request->get('nombre');
        $patologia->estado = 1;
        $patologia->save();

        return redirect()->route('patologia.index');
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
        $patologia = Patologia::findOrFail($id);

        return view('patologia.edit',['patologia'=>$patologia]);
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
        $patologia = Patologia::findOrFail($id);
        $patologia->nombre = $request->get('nombre');
        $patologia->update();

        return redirect()->route('patologia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patologia = Patologia::findOrFail($id);
        $patologia->estado=0;
        $patologia->update();

        return redirect()->route('patologia.index');
    }
}
