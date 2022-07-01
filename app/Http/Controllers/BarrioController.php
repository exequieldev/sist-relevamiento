<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manzana;
use App\Models\BarriosManzana;
use App\Models\Barrio;
use DB;

class BarrioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $barrios=Barrio::orderBy('idBarrio','desc')->where('estado',1)->paginate(5);
       return view('barrio.index', ['barrios'=>$barrios]);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('barrio.create');
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
            'nombre' => 'required|unique:barrios|alpha_num',
            
        ],
        [
            'nombre.required' => 'Debe especificar un nombre de Barrio, no se admiten campos vacios.',
            'nombre.unique' => 'El Barrio que intenta ingresar ya existe.',
            'nombre.alpha_num' => 'El nombre del Barrio debe contener letras y números.'
        ]
        );
        
        $barrio = new Barrio;
        $barrio->nombre = $request->get('nombre');
        $barrio->estado = 1;
        $barrio->save();

        $manzana = new Manzana;
        $manzana->numero = "Sin Numero";
        $manzana->division = "Sin Manzana";
        $manzana->estado = 1;
        $manzana->save();

        $barrioManzana = new BarriosManzana;
        $barrioManzana->idBarrio = $barrio->idBarrio;
        $barrioManzana->idManzana = $manzana->idManzana;
        $barrioManzana->save();


        return redirect()->route('barrio.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barrio = Barrio::findOrFail($id);

        return view('barrio.show',['barrio'=>$barrio]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barrio = Barrio::findOrFail($id);

        return view('barrio.edit',['barrio'=>$barrio]);
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
            'nombre.required' => 'Debe especificar un nombre de Barrio, no se admiten campos vacios.'
        ]
        );

        $barrio = Barrio::findOrFail($id);
        $barrio->nombre = $request->get('nombre');
        $barrio->update();

        return redirect()->route('barrio.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barrio = Barrio::findOrFail($id);
        $barrio->estado=0;
        $barrio->update();
        


        return redirect()->route('barrio.index');
    }

    
}
