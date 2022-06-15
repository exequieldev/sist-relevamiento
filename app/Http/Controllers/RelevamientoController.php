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

        $relevamientos = BarriosManzana::orderBy('idBarrio_Manzanas','desc')
            ->join('barrios','barrio_manzanas.idBarrio','=','barrios.idBarrio')
            ->join('manzanas','barrio_manzanas.idManzana', '=', 'manzanas.idManzana')
            ->join('manzana_lotes','manzana_lotes.idManzana','=','manzanas.idManzana')
            ->join('lotes','lotes.idLote','=', 'manzana_lotes.idLote')
            ->join('casas','lotes.idLote' ,'=' ,'casas.idLote')
            ->join('hogares','hogares.idCasa','=','casas.idCasa')
            ->join('personas','personas.idhogar','=','hogares.idHogar')
            ->join('relevamientos','relevamientos.idCasa','=','casas.idCasa')
            ->where('relevamientos.estado',1)
            ->select('relevamientos.idRelevamiento as idRelevamiento','relevamientos.fechaDesde as fechaDesde','barrios.nombre as nombre','manzanas.division as descripcion','lotes.numero as lote','casas.numeroCasa as casa','casas.division as division')
            ->get()
            ->groupBy('casa');
            //dd($relevamientos);
            
       
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
        $detalleHabitaciones = DetalleHabitacion::all();

        $habitaciones = Habitacion::where('estado', 1)
        ->whereIn('idHabitacion', DetalleHabitacion::select('idHabitacion'))          //Para controlar que no devuelva una habitacion sin detalles de habitacion registrados.
        ->get();

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
            $buscarCasa = BarriosManzana::orderBy('idCasa','desc')->join('barrios','barrio_manzanas.idBarrio','=','barrios.idBarrio')
            ->join('manzanas','barrio_manzanas.idManzana', '=', 'manzanas.idManzana')
            ->join('manzana_lotes','manzana_lotes.idManzana','=','manzanas.idManzana')
            ->join('lotes','lotes.idLote','=', 'manzana_lotes.idLote')
            ->join('casas','lotes.idLote' ,'=' ,'casas.idLote')
            ->where('barrios.nombre','=','Canteras')
            ->where('casas.numeroCasa','=',$request->casa)
            ->select('casas.numeroCasa as nombre','lotes.idLote as Lote','casas.idCasa','casas.division')
            ->first();
            //dd($buscarCasa);
            if(!empty($buscarCasa)){
                
                $casa = new Casa;
                $casa->idLote = $buscarCasa->Lote;
                $casa->numeroCasa = $request->casa;
                
                $array = array("A", "B", "C", "D","E", "F", "G", "H","I", "J", "K", "L","M", "N", "Ñ", "O","P", "Q", "R", "S","T","U","V","W","X","Y","Z");
                
                if (in_array($buscarCasa->division,$array)) {
                   $casa->division = $array[array_search($buscarCasa->division,$array) + 1];     
                }
                
                $casa->estado = 1;
                $casa->save();
                
            }else{
                $manzana=BarriosManzana::join('barrios','barrio_manzanas.idBarrio','=','barrios.idBarrio')
                ->join('manzanas','barrio_manzanas.idManzana', '=', 'manzanas.idManzana')
                ->where('barrios.nombre','=','Canteras')
                ->where('manzanas.division','=','Sin Manzana')
                ->select('barrios.nombre as barrio','manzanas.division as manazana','manzanas.idManzana')
                ->first();
                //dd($manzana);

                $lote = new Lote;
                $lote->numero = 'Sin Lote';
                $lote->estado = 1;
                $lote->save();

                $manzanaLote = new ManzanaLote;
                $manzanaLote->idManzana = $manzana->idManzana;
                $manzanaLote->idLote = $lote->idLote;
                $manzanaLote->save();

                $casa = new Casa;
                $casa->idLote = $lote->idLote;
                $casa->numeroCasa = $request->casa;
                $casa->division = "A";
                $casa->estado = 1;
                $casa->save();
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

        $detalleshab = $request->input('detallehab');

        if(!empty($detalleshab)){
            //Foreach para Habitaciones y detalles asociados.
             foreach ($detalleshab as $habitacion => $valor) {
                //  print("Habitacion: ");
                //  print_r($habitacion);
                 foreach ($valor as $detallehab => $value) {
                    //  print("Detalle Habitacion: ");
                    //  print($detallehab);
                     $casaHabitacion = new CasaHabitacion;
                     $casaHabitacion->idCasa = $casa->idCasa;
                     $casaHabitacion->idHabitacion = $detallehab;
                     $casaHabitacion->save();
                     //insert($habitacion, $detallehab)
    
                 }
             }

        }

        //dd($grupos[array_key_last($grupos)]);                     //Obtenemos el num del último grupo registrado.
        $indice = 1;
        for ($j=0; $j < $grupos[array_key_last($grupos)]; $j++){
            
                $grupo = new Hogar;
                $grupo->idCasa = $casa->idCasa;
                $grupo->save();
                
                for ($i=0; $i < count($grupos); $i++) {
                    if ($grupos[$i] == $indice){
                        $persona = new Persona;
                        $persona->vinculo = $vinculos[$i];
                        $persona->nombres = $nombres[$i];
                        $persona->apellidos = $apellidos[$i];
                        $persona->fechaNacimiento = '2022-06-08';
                        $persona->dni = $dni[$i];
                        $persona->ocupacion = 'maestro';
                        $persona->idhogar = $grupo->idhogar;
                        $persona->save();
                    }
                }

            $relevamiento = new Relevamiento;
            $relevamiento->fechaDesde = '2022-06-08';
            $relevamiento->idCasa = $casa->idCasa;
            $relevamiento->estado = 1;
            $relevamiento->save();
            $indice++;
        }        

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

        $relevamientos = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
            ->join('lotes','lotes.idLote','=', 'casas.idLote')
            ->join('manzana_lotes','manzana_lotes.idLote','=','lotes.idLote')
            ->join('manzanas','manzanas.idManzana','=','manzana_lotes.idManzana')
            ->join('barrio_manzanas','barrio_manzanas.idManzana','=','manzanas.idManzana')
            ->join('barrios','barrios.idBarrio','=','barrio_manzanas.idBarrio')
            ->where('relevamientos.estado', 1)
            ->where('relevamientos.idRelevamiento', $id)
            ->select('relevamientos.fechaDesde as fechaDesde','barrios.nombre as nombre','manzanas.division as descripcion','lotes.numero as lote','casas.numeroCasa as casa','casas.division as division')
            ->get()
            ->groupBy('idLote');
            //dd($relevamientos);

            $construcciones = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
            ->join('casasdetalleconstrucciones','casas.idCasa','=', 'casasdetalleconstrucciones.idCasa')
            ->join('detalleconstrucciones','casasdetalleconstrucciones.iddetalleConstruccion','=', 'detalleconstrucciones.iddetalleConstruccion')
            ->join('construcciones','detalleconstrucciones.idConstruccion','=', 'construcciones.idConstruccion')
            ->where('relevamientos.estado', 1)
            ->where('relevamientos.idRelevamiento', $id)
            ->select('construcciones.nombre as nombrecons','detalleConstrucciones.nombre as nombredetallecons')
            ->get();
            //dd($construcciones);


            $detallecasa = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
            ->join('detallecasa','casas.idCasa','=', 'detallecasa.idCasa')
            ->where('relevamientos.estado', 1)
            ->where('relevamientos.idRelevamiento', $id)
            ->select('detallecasa.tipoVivienda as tipovivienda','detallecasa.hacinamiento as hacinamiento', 'detallecasa.numeroHabitacion as habitaciones')
            ->get();
            //dd($detallecasa);

            
            $detallehabitaciones = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
            ->join('casahabitaciones','casas.idCasa','=', 'casahabitaciones.idCasa')
            ->join('habitaciones','casahabitaciones.idHabitacion','=', 'habitaciones.idHabitacion')
            ->join('detallehabitaciones','detallehabitaciones.idHabitacion','=', 'habitaciones.idHabitacion')
            ->where('relevamientos.estado', 1)
            ->where('relevamientos.idRelevamiento', $id)
            ->select('habitaciones.nombre as nombrehab', 'detallehabitaciones.nombre as nombredetallehab')
            ->get();
            //dd($detallehabitaciones);


            $personas = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
            ->join('hogares','hogares.idCasa', '=', 'casas.idCasa')
            ->join('personas','hogares.idhogar', '=', 'personas.idhogar')
            ->where('relevamientos.estado', 1)
            ->where('relevamientos.idRelevamiento', $id)
            ->select('personas.nombres as nombres', 'personas.apellidos as apellidos', 'personas.dni as dni', 'personas.fechaNacimiento as fechanac', 'personas.idhogar as hogar', 'personas.vinculo as vinculo')
            ->get();
            //dd($personas);



        return view('relevamiento.show',['relevamientos'=>$relevamientos, 'construcciones'=>$construcciones, 'detallecasa'=> $detallecasa, 'detallehabitaciones'=> $detallehabitaciones, 'personas'=>$personas]);
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
