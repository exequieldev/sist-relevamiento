<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\Telefono;
use App\Models\DetalleCasa;
use App\Models\CasaDetalleConstruccion;
use App\Models\CasaHabitacion;
use App\Models\Barrio;
use App\Models\BarriosManzana;
use App\Models\Manzana;
use App\Models\Lote;
use App\Models\ManzanaLote;
use App\Models\Hogar;
use App\Models\Persona;
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

        $relevamientos = BarriosManzana::join('barrios','barrio_manzanas.idBarrio','=','barrios.idBarrio')
            ->join('manzanas','barrio_manzanas.idManzan', '=', 'manzanas.idManzana')
            ->join('manzana_lotes','manzana_lotes.Manzanas_idManzana','=','manzanas.idManzana')
            ->join('lotes','lotes.idLote','=', 'manzana_lotes.idLote')
            ->join('casas','lotes.idLote' ,'=' ,'casas.idLote')
            ->join('hogares','hogares.idCasa','=','casas.idCasa')
            ->join('personas','personas.hogares_idhogar','=','hogares.idHogar')
            ->join('relevamientos','relevamientos.idHogar','=','hogares.idHogar')
            ->where('relevamientos.estado',1)
            ->select('relevamientos.idRelevamiento','relevamientos.fechaDesde','barrios.nombre','manzanas.descripcion','lotes.numero as lote','casas.nombre as casa')
            ->get();
        //dd($relevamientos);
        //$relevamientos=Relevamiento::orderBy('idRelevamiento','desc')->where('estado',1)->get();
        
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

       
        if ($request->manzana == null && $request->numero == null && $request->lote == null) {

            $buscarCasa = BarriosManzana::join('barrios','barrio_manzanas.idBarrio','=','barrios.idBarrio')
            ->join('manzanas','barrio_manzanas.idManzan', '=', 'manzanas.idManzana')
            ->join('manzana_lotes','manzana_lotes.Manzanas_idManzana','=','manzanas.idManzana')
            ->join('lotes','lotes.idLote','=', 'manzana_lotes.idLote')
            ->join('casas','lotes.idLote' ,'=' ,'casas.idLote')
            ->where('barrios.nombre','=','Andresito')
            ->where('casas.nombre','=',$request->casa)
            ->select('casas.nombre as nombre','lotes.idLote as Lote')
            ->first();
            
            if(!empty($buscarCasa)){
                $casa = new Casa;
                $casa->idLote = $buscarCasa->Lote;
                $casa->nombre = $request->casa;
                //$casa->division
                $casa->estado = 1;
                $casa->save();
            }else{
                $manzana=Manzana::orderBy('idManzana','desc')
                ->where('estado',1)
                ->where('descripcion','=','NNN')
                //->orwhere('numero','=','000')
                ->first();

                $lote = new Lote;
                $lote->numero = 00;
                $lote->estado = 1;
                $lote->save();

                $manzanaLote = new ManzanaLote;
                $manzanaLote->idManzana = $manzana->idManzana;
                $manzanaLote->idLote = $lote->idLote;
                $manzanaLote->save();

                $casa = new Casa;
                $casa->idLote = $lote->idLote;
                $casa->nombre = $request->casa;
                //$casa->division
                $casa->estado = 1;
                $casa->save();
            }

        }else{
            $buscarCasa = BarriosManzana::join('barrios','barrio_manzanas.idBarrio','=','barrios.idBarrio')
            ->join('manzanas','barrio_manzanas.idManzan', '=', 'manzanas.idManzana')
            ->join('manzana_lotes','manzana_lotes.Manzanas_idManzana','=','manzanas.idManzana')
            ->join('lotes','lotes.idLote','=', 'manzana_lotes.idLote')
            ->join('casas','lotes.idLote' ,'=' ,'casas.idLote')
            ->where('barrios.nombre','=','Andresito')
            ->where('casas.nombre','=',$request->casa)
            ->select('casas.nombre as nombre','lotes.idLote as Lote')
            ->first();
            
            if(!empty($buscarCasa)){
                $casa = new Casa;
                $casa->idLote = $buscarCasa->Lote;
                $casa->nombre = $request->casa;
                //$casa->division
                $casa->estado = 1;
                $casa->save();
            }else{
                $manzana = new Manzana;
                $manzana->descripcion = $request->numero;
                $manzana->estado = 1;
                $manzana->save();

                $lote = new Lote;
                $lote->numero = $request->numero;
                $lote->estado = 1;
                $lote->save();

                $barriosManzana = new BarriosManzana;
                $barriosManzana->idBarrio = 1;
                $barriosManzana->idManzan = $manzana->idManzana;
                $barriosManzana->save();

                $manzanaLote = new ManzanaLote;
                $manzanaLote->Manzanas_idManzana = $manzana->idManzana;
                $manzanaLote->idLote = $lote->idLote;
                $manzanaLote->save();

                $casa = new Casa;
                $casa->idLote = $lote->idLote;
                $casa->nombre = $request->casa;
                //$casa->division
                $casa->estado = 1;
                $casa->save();
            }
            //dd('Teminado');
        }
        
        
        $telefono = new Telefono;
        $telefono->numero = $request->input('telefono');
        $telefono->idCasa = $casa->idCasa;
        $telefono->save();

        $grupos = $request->get('grupos');
        $vinculos = $request->get('vinculos');
        $nombres = $request->get('nombres');
        $apellidos = $request->get('apellidos');
        $fechaNac = $request->get('fechaNac');
        $dni = $request->get('dni');

        $detallescons = $request->input('detallecons');
        $detalleshab = $request->input('detallehab');


        //Foreach para Construcciones y detalles asociados.
        foreach ($detallescons as $construccion => $valor) {
            
            foreach ($valor as $detallecons => $value) {
                
                //insert($construccion, $detallecons)
                $casadetalleconstruccion = new CasaDetalleConstruccion;
                $casadetalleconstruccion->idCasa =  $casa->idCasa;
                $casadetalleconstruccion->iddetalleConstruccion = $detallecons;
                $casadetalleconstruccion->save();
            }
        }

        $detalleCasa = new DetalleCasa;
        $detalleCasa->idCasa = $casa->idCasa;
        $detalleCasa->tipoVivienda = 1;
        $detalleCasa->hacinamiento = 1;
        $detalleCasa->numeroHabitacion = $request->input('numeroHabitacion');
        $detalleCasa->save();


        //Foreach para Habitaciones y detalles asociados.
         foreach ($detalleshab as $habitacion => $valor) {
            //  print("Habitacion: ");
            //  print_r($habitacion);
             foreach ($valor as $detallehab => $value) {
                //  print("Detalle Habitacion: ");
                //  print($detallehab);
                 $casaHabitacion = new CasaHabitacion;
                 $casaHabitacion->idCasa = $casa->idCasa;
                 $casaHabitacion->idDetalleHabitacion = $detallehab;
                 $casaHabitacion->save();
                 //insert($habitacion, $detallehab)

             }
         }
        $indice = 1;
        for ($j=0; $j < count($vinculos); $j++){
            

            if ($grupos[$j]==$indice){
                $grupo = new Hogar;
                $grupo->idCasa = $casa->idCasa;
                $grupo->save();
                
                for ($i=0; $i < count($vinculos); $i++) {
                    $persona = new Persona;
                    $persona->vinculo = $vinculos[$i];
                    $persona->nombres = $nombres[$i];
                    $persona->apellidos = $apellidos[$i];
                    $persona->fechaNacimiento = '2022-06-08';
                    $persona->dni = $dni[$i];
                    $persona->ocupacion = 'maestro';
                    $persona->hogares_idhogar = $grupo->idhogar;
                    $persona->save();
                }
                
            }
            $indice++;
                $relevamiento = new Relevamiento;
                $relevamiento->fechaDesde = '2022-06-08';
                $relevamiento->idhogar = $grupo->idhogar;
                $relevamiento->estado = 1;
                $relevamiento->save();
        }

        
        
        
        dd($relevamiento);
        

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
