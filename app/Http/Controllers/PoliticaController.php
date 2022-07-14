<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Politica;
use App\Models\Programa;
class PoliticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $politicas =Politica::orderBy('idPolitica','desc')->where('estado',1)->paginate(5);
        return view('politica.index', ['politicas'=>$politicas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('politica.create');
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
            'nombre' => 'required|unique:politicas'
        ],
        [
            'nombre.required' => 'Debe especificar un nombre de la Politica, no se admiten campos vacios.',
            'nombre.unique' => 'La Politica que intenta ingresar ya existe.'
        ]
    
        );

        $politica = new Politica;
        $politica->nombre = $request->get('nombre');
        $politica->estado = 1;
        $politica->save();

        return redirect()->route('politica.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $politica = Politica::findOrfail($id);
        $programas =Programa::orderBy('idPrograma','desc')
        ->where('idPolitica', $id)
        ->where('estado',1)
        ->paginate(5);

        return view('politica.show',['programas'=>$programas, 'idPolitica' => $id,
        'nombre' => $politica->nombre]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $politica = Politica::findOrFail($id);

        return view('politica.edit',['politica'=>$politica]);
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
            'nombre.required' => 'Debe especificar un nombre de la Politica, no se admiten campos vacios.',
        ]
        );

        $politica = Politica::findOrFail($id);
        $politica->nombre = $request->get('nombre');
        $politica->update();

        return redirect()->route('politica.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $politica = Politica::findOrFail($id);
        $politica->estado=0;
        $politica->update();
        


        return redirect()->route('politica.index');
    }
}
