<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use Illuminate\Http\Request;

class CasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casas=Casa::orderBy('idCasa','desc')->where('estado',1)->paginate(5);

        return view('casa.index', ['casas'=>$casas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('casa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $casa = new Casa;
        $casa->nombre = $request->get('nombre');
        $casa->estado = 1;
        $casa->save();

        return redirect()->route('casa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Casa  $casa
     * @return \Illuminate\Http\Response
     */
    public function show(Casa $casa)
    {
        $casa = Casa::findOrFail($id);

        return view('casa.show',['casa'=>$casa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Casa  $casa
     * @return \Illuminate\Http\Response
     */
    public function edit(Casa $casa)
    {
        $casa = Casa::findOrFail($id);

        return view('casa.edit',['casa'=>$casa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Casa  $casa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Casa $casa)
    {
        $casa = Casa::findOrFail($id);
        $casa->nombre = $request->get('nombre');
        $casa->update();

        return redirect()->route('casa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Casa  $casa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $csa = Casa::findOrFail($id);
        $casa->estado=0;
        $casa->update();

        return redirect()->route('casa.index');
    }
}
