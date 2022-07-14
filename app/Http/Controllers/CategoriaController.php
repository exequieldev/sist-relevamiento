<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\InstitucionMedica;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias=Categoria::orderBy('idCategoria','desc')->where('estado',1)->paginate(5);
        return view('categoria.index', ['categorias'=>$categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoria.create');
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
            'nombre' => 'required|unique:categorias'
        ],
        [
            'nombre.required' => 'Debe especificar un nombre de la Categoria, no se admiten campos vacios.',
            'nombre.unique' => 'La categoria que intenta ingresar ya existe.'
        ]
    
        );

        $categoria = new categoria;
        $categoria->nombre = $request->get('nombre');
        $categoria->estado = 1;
        $categoria->save();

        return redirect()->route('categoria.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::findOrfail($id);
        $institucionMedica =InstitucionMedica::orderBy('idInstitucionMedica','desc')
        ->where('idCategoria', $id)
        ->where('estado',1)
        ->paginate(5);

        return view('categoria.show',['institucionMedica'=>$institucionMedica, 'idCategoria' => $id,
        'nombre' => $categoria->nombre]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('categoria.edit',['categoria'=>$categoria]);
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
            'nombre.required' => 'Debe especificar un nombre de la Categoria, no se admiten campos vacios.',
        ]
        );

        $categoria = Categoria::findOrFail($id);
        $categoria->nombre = $request->get('nombre');
        $categoria->update();

        return redirect()->route('categoria.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->estado=0;
        $categoria->update();
        


        return redirect()->route('categoria.index');
    }
}
