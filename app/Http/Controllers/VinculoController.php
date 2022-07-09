<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vinculo;

class VinculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vinculos = Vinculo::orderBy('idVinculo','desc')->where('estado',1)->paginate(5);

        return view('vinculo.index', ['vinculos'=>$vinculos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vinculo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vinculo = new Vinculo;
        $vinculo->nombre = $request->get('nombre');
        $vinculo->estado = 1;
        $vinculo->save();

        return redirect()->route('vinculo.index');
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
        $vinculo = Vinculo::findOrFail($id);

        return view('vinculo.edit',['vinculo'=>$vinculo]);
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
        $vinculo = Vinculo::findOrFail($id);
        $vinculo->nombre = $request->get('nombre');
        $vinculo->update();

        return redirect()->route('vinculo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vinculo = Vinculo::findOrFail($id);
        $vinculo->estado=0;
        $vinculo->update();

        return redirect()->route('vinculo.index');
    }
}
