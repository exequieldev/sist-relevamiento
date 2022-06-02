<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\Telefono;
use App\Models\DetalleCasa;
use App\Models\Barrio;
use App\Models\Manzana;
use App\Models\Lote;
use App\Models\Relevamiento;
use App\Models\DetalleConstruccion;
use App\Models\Construccion;
use App\Models\Habitacion;
use App\Models\DetalleHabitacion;

use Illuminate\Http\Request;

use DB;

class RelevamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $relevamientos=Relevamiento::orderBy('idRelevamiento','desc')->where('estado',1)->paginate(5);
        return view('relevamiento.index', ['relevamientos'=>$relevamientos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barrios = Barrio::all();
        $manzanas = Manzana::all();
        $lotes = Lote::all();
        $detalleConstrucciones = DetalleConstruccion::all();
        $habitaciones = Habitacion::all();
        $detalleHabitaciones = DetalleHabitacion::all();

        $construcciones = Construccion::where('estado', 1)
        ->whereIn('idConstruccion', DetalleConstruccion::select('idConstruccion'))          //Para controlar que no devuelva una construcción sin detalles de construccion registrados.
        ->get();
        
        //dd($construcciones);
        return view('relevamiento.create',compact('barrios','manzanas','lotes','detalleConstrucciones','construcciones','habitaciones','detalleHabitaciones'));
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
        $casa->idlote = $request->input('lote');
        $casa->nombre = $request->input('lote');
        $casa->iddetalleConstruccion = 18;
        $casa->estado = 1;
        $casa->save();

        $telefono = new Telefono;
        $telefono->tipoTelefono = 'celular';
        $telefono->numero = $request->input('telefono');
        $telefono->idCasa = $casa->idCasa;
        $telefono->save();


        dd($request);
        $detallescons = $request->input('detallecons');
        $detalleshab = $request->input('detallehab');

        //dd($detalle);

        //Foreach para Construcciones y detalles asociados.
        foreach ($detallescons as $construccion => $valor) {
            print("Construccion: ");
            print_r($construccion);
            foreach ($valor as $detallecons => $value) {
                print("Detalle Construcción: ");
                print($detallecons);
                //insert($construccion, $detallecons)
            }
        }

        $detalleCasa = new DetalleCasa;
        $detalleCasa->idCasa = $casa->idCasa;
        $detalleCasa->tipoVivienda = $request->input('tipoVivienda');
        $detalleCasa->hacinamiento = $request->input('hacinamiento');
        $detalleCasa->numeroHabitacion = $request->input('numeroHabitacion');
        $detalleCasa->save();


        //Foreach para Habitaciones y detalles asociados.
        foreach ($detalleshab as $habitacion => $valor) {
            print("Habitacion: ");
            print_r($habitacion);
            foreach ($valor as $detallehab => $value) {
                print("Detalle Habitacion: ");
                print($detallehab);

                //insert($habitacion, $detallehab)

            }
        }

        $relevamiento = new Relevamiento;
        $relevamiento->fechaDesde = $request->get('fechaDesde');
        $relevamiento->fechaDesde = $request->get('');

        
        
        
        $relevamiento->estado = 1;
        $relevamiento->save();

        return redirect()->route('relevamiento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Relevamiento  $relevamiento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relevamiento = Relevamiento::findOrFail($id);

        return view('relevamiento.show',['relevamiento'=>$relevamiento]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Relevamiento  $relevamiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relevamiento = Relevamiento::findOrFail($id);

        return view('relevamiento.edit',['relevamiento'=>$relevamiento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Relevamiento  $relevamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $relevamiento = Relevamiento::findOrFail($id);
        $relevamiento->fechaDesde = $request->get('fechaDesde');
        $relevamiento->update();

        return redirect()->route('relevamiento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Relevamiento  $relevamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $relevamiento = Relevamiento::findOrFail($id);
        $relevamiento->estado=0;
        $relevamiento->update();

        return redirect()->route('relevamiento.index');
    }
}
