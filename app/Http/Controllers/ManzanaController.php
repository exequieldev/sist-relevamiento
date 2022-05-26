<?php

namespace App\Http\Controllers;

use App\Models\Manzana;
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
        $manzanas=Manzana::orderBy('idManzana','desc')->where('estado',1)->paginate(5);
       return view('manzana.index', ['manzanas'=>$manzanas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manzana.create');
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
        $manzana->descripcion = $request->get('descripcion');
        $manzana->estado = 1;
        $manzana->save();

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
