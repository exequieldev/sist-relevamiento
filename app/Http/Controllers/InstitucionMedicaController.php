<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstitucionMedica;

class InstitucionMedicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'nombre' => 'required|unique:institucionmedicas'
        ],
        [
            'nombre.required' => 'Debe especificar un nombre de la Insitucion Medica, no se admiten campos vacios.',
            'nombre.unique' => 'La institucion medica que intenta ingresar ya existe.'
        ]
    
        );
        $institucionmedica = new InstitucionMedica;
        $institucionmedica->nombre = $request->get('nombre');
        $institucionmedica->estado = 1;
        $institucionmedica->idCategoria = $request->get('categoria');
        $institucionmedica->save();

        return redirect()->route('categoria.show', $institucionmedica->idCategoria);
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
        $institucion = InstitucionMedica::findOrFail($id);

        return view('institucionmedica.edit',['institucion'=>$institucion]);
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
            'nombre.required' => 'Debe especificar un nombre la institucion medica, no se admiten campos vacios.'
        ]
    
        );
        $institucionmedica = InstitucionMedica::findOrFail($id);
        $institucionmedica->nombre = $request->get('nombre');
        $institucionmedica->update();

        return redirect()->route('categoria.show', $institucionmedica->idCategoria);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $institucionmedica = InstitucionMedica::findOrFail($id);
        $institucionmedica->estado=0;
        $institucionmedica->update();
        


        return redirect()->route('categoria.show', $institucionmedica->idCategoria);
    }
}
