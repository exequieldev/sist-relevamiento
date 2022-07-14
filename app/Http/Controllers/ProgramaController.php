<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programa;

class ProgramaController extends Controller
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
        //
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
            'nombre' => 'required|unique:programas'
        ],
        [
            'nombre.required' => 'Debe especificar un nombre del programa, no se admiten campos vacios.',
            'nombre.unique' => 'El nomrbre del programa que intenta ingresar ya existe.'
        ]
    
        );
        $programa = new Programa;
        $programa->nombre = $request->get('nombre');
        $programa->monto = $request->get('monto');
        $programa->estado = 1;
        $programa->idPolitica = $request->get('politica');
        $programa->save();

        return redirect()->route('politica.show', $programa->idPolitica);
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
        $programa = Programa::findOrFail($id);

        return view('programa.edit',['programa'=>$programa]);
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
            'nombre.required' => 'Debe especificar un nombre del programa, no se admiten campos vacios.'
        ]
    
        );
        $programa = Programa::findOrFail($id);
        $programa->nombre = $request->get('nombre');
        $programa->monto = $request->get('monto');
        $programa->update();

        return redirect()->route('politica.show', $programa->idPolitica);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $programa = Programa::findOrFail($id);
        $programa->estado=0;
        $programa->update();
        


        return redirect()->route('politica.show', $programa->idPolitica);
    }
}
