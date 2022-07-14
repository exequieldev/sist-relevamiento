<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObraSocial;

class ObraSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obrasociales=ObraSocial::orderBy('idObraSocial','desc')->where('estado',1)->paginate(5);
        return view('obrasocial.index', ['obrasociales'=>$obrasociales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('obrasocial.create');
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
            'nombre' => 'required|unique:obrasociales'
        ],
        [
            'nombre.required' => 'Debe especificar un nombre de la Obra Social, no se admiten campos vacios.',
            'nombre.unique' => 'La Obra Social que intenta ingresar ya existe.'
        ]
    
        );

        $obrasocial = new ObraSocial;
        $obrasocial->nombre = $request->get('nombre');
        $obrasocial->estado = 1;
        $obrasocial->save();

        return redirect()->route('obrasocial.index');
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
        $obrasocial = ObraSocial::findOrFail($id);

        return view('obrasocial.edit',['obrasocial'=>$obrasocial]);
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
            'nombre.required' => 'Debe especificar un nombre de la Obra Social, no se admiten campos vacios.',
        ]
        );

        $obrasocial = ObraSocial::findOrFail($id);
        $obrasocial->nombre = $request->get('nombre');
        $obrasocial->update();

        return redirect()->route('obrasocial.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obrasocial = ObraSocial::findOrFail($id);
        $obrasocial->estado=0;
        $obrasocial->update();
        


        return redirect()->route('obrasocial.index');
    }
}
