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
use App\Models\Embarazo;
use App\Models\Patologia;
use App\Models\Ingreso;
use App\Models\Discapacidad;
use App\Models\Programa;
use App\Models\HogarPrograma;
use App\Models\HogarMovimiento;
use App\Models\HogarObraSocial;
use App\Models\HogarInstitucionMedica;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Arr;

use function PHPUnit\Framework\isEmpty;

class RelevamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        /*$relevamientos = BarriosManzana::orderBy('idBarrio_Manzanas','desc')
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
            dd($relevamientos);*/
            //DB::enableQueryLog();
            $relevamientos = Relevamiento::orderBy('idRelevamiento', 'desc')
            ->join('casas','relevamientos.idCasa' ,'=' ,'casas.idCasa')
            ->join('lotes','casas.idLote','=', 'lotes.idLote')
            ->join('manzana_lotes','lotes.idLote','=', 'manzana_lotes.idLote')
            ->join('manzanas','manzana_lotes.idManzana','=', 'manzanas.idManzana')
            ->join('barrio_manzanas','manzanas.idManzana','=', 'barrio_manzanas.idManzana')
            ->join('barrios','barrio_manzanas.idBarrio','=', 'barrios.idBarrio')
            ->select('relevamientos.idRelevamiento as idRelevamiento','relevamientos.fechaDesde as fechaDesde','barrios.nombre as nombre','manzanas.division as descripcion','lotes.numero as lote','casas.numeroCasa as casa','casas.division as division')
            ->get()
            ->groupBy('casa');
            //dd(DB::getQueryLog());
           // dd($relevamientos);

       
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
        $niveles = DB::table('niveles')->where('estado', 1)->get()->toArray();
        $patologias = DB::table('patologias')->where('estado', 1)->get()->toArray();
        $vinculos = DB::table('vinculos')->where('estado', 1)->get()->toArray();
        $generos = DB::table('generos')->where('estado', 1)->get()->toArray();
        $ocupaciones = DB::table('ocupaciones')->where('estado', 1)->get()->toArray();
        $situacionesocupacionales = DB::table('situacionocupacionales')->where('estado', 1)->get()->toArray();
        $obrasociales = DB::table('obrasociales')->where('estado', 1)->get()->toArray();

        $programaSociales = Programa::orderBy('idPrograma', 'desc')
        ->join('politicas','programas.idPolitica','=','politicas.idPolitica')
        ->where('programas.estado',1)
        ->where('politicas.nombre','Sociales')
        ->select('programas.idPrograma','programas.nombre as programa','programas.monto','politicas.nombre as politica')->get()->toArray();
        
        $programaProvinciales = Programa::orderBy('idPrograma', 'desc')
        ->join('politicas','programas.idPolitica','=','politicas.idPolitica')
        ->where('programas.estado',1)
        ->where('politicas.nombre','Provinciales')
        ->select('programas.idPrograma','programas.nombre as programa','programas.monto','politicas.nombre as politica')
        ->get()->toArray();
        
        $movimientoSocial = DB::table('movimientosociales')->where('estado', 1)->get()->toArray();

        $intitucionMedica = DB::table('institucionmedicas')->where('estado', 1)->get()->toArray();

        $habitaciones = Habitacion::where('estado', 1)
        ->whereIn('idHabitacion', DetalleHabitacion::select('idHabitacion'))          //Para controlar que no devuelva una habitacion sin detalles de habitacion registrados.
        ->get();

        $construcciones = Construccion::where('estado', 1)
        ->whereIn('idConstruccion', DetalleConstruccion::select('idConstruccion'))          //Para controlar que no devuelva una construcción sin detalles de construccion registrados.
        ->get();
        
        //dd($construcciones);
        return view('relevamiento.create',compact('barrios','manzanas','lotes','detalleConstrucciones','construcciones','habitaciones','detalleHabitaciones', 'niveles', 'patologias', 'vinculos', 'generos', 'ocupaciones', 'situacionesocupacionales','obrasociales','programaSociales','programaProvinciales','movimientoSocial','intitucionMedica'));
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
            'numeroHabitacion' => 'required|integer|gt:0',
            'casa' => 'required|numeric|gt:0',
            'fechaNac.*'  => 'required|date_format:Y-m-d'
        ],
        [
            'numeroHabitacion.required' => 'Debe especificar una cantidad de habitaciones.',
            'numeroHabitacion.integer' => 'El Número de Habitaciones debe ser un número.',
            'numeroHabitacion.gt' => 'El Número de Habitaciones debe ser 1 o más.',
            'casa.required' => 'Debe especificar el número de la Casa.',
            'casa.numeric' => 'Debe especificarse un número de Casa, no letras, no símbolos.',
            'casa.gt' => 'El número de la Casa debe mayor que 0.',
            'fechaNac.*required' => 'Debe especificar una fecha de nacimiento.',
            'fechaNac.*date_format' => 'La fecha debe estar especificada de la siguiente manera: "Año/Mes/Dia".'
        ]
        );

        try {
            //dd('Estamos aca');
            DB::beginTransaction();
            $buscarCasa = BarriosManzana::orderBy('idCasa','desc')->join('barrios','barrio_manzanas.idBarrio','=','barrios.idBarrio')
            ->join('manzanas','barrio_manzanas.idManzana', '=', 'manzanas.idManzana')
            ->join('manzana_lotes','manzana_lotes.idManzana','=','manzanas.idManzana')
            ->join('lotes','lotes.idLote','=', 'manzana_lotes.idLote')
            ->join('casas','lotes.idLote' ,'=' ,'casas.idLote')
            ->where('barrios.nombre','=','Canteras')
            ->where('casas.numeroCasa','=',$request->casa)
            ->select('casas.numeroCasa as nombre','lotes.idLote as Lote','casas.idCasa','casas.division')
            ->first();

            
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

        if($request->input('telefono') != null){
            $telefono = new Telefono;
            $telefono->numero = $request->input('telefono');
            $telefono->idCasa = $casa->idCasa;
            $telefono->save();            
        }
        

        $grupos = $request->get('grupos');
        $vinculos = $request->get('vinculos');
        $nombres = $request->get('nombres');
        $apellidos = $request->get('apellidos');
        $fechaNac = $request->get('fechaNac');
        $dni = $request->get('dni');
        $obrasociales = $request->get('obraSociales');
        //dd($grupos);
        $detallescons = $request->input('detallecons');
        //dd($detallescons);


        //Foreach para Construcciones y detalles asociados.
        //dd($detallescons);
        if(!empty($detallescons)){
        foreach ($detallescons as $construccion => $valor) {
            
            foreach ($valor as $detallecons => $value) {
               
                //insert($construccion, $detallecons)
                $casadetalleconstruccion = new CasaDetalleConstruccion;
                $casadetalleconstruccion->idCasa =  $casa->idCasa;
                $casadetalleconstruccion->iddetalleConstruccion = $detallecons;
                $casadetalleconstruccion->save();
            }
        }
    }
    
        $detalleCasa = new DetalleCasa;
        $detalleCasa->idCasa = $casa->idCasa;
        if ($request->input('tipoVivienda') == null) {
            $detalleCasa->tipoVivienda = 0;
        }else{
            $detalleCasa->tipoVivienda = 1;
        }
        if ($request->input('hacinamiento')==null) {
            $detalleCasa->hacinamiento = 0;
        }else{
            $detalleCasa->hacinamiento = 1;
        }
        $detalleCasa->numeroHabitacion = $request->input('numeroHabitacion');
        $detalleCasa->save();
        

        //La parte de habitaciones esta no funcional, se necesita una unión entre la casa y el detalle de la habitación.
        //La relación de casa con habitacion está mal.

        $detalleshab = $request->input('detallehab');
        if(!empty($detalleshab)){
            //Foreach para Habitaciones y detalles asociados.
             foreach ($detalleshab as $habitacion => $valor) {
                
                 foreach ($valor as $detallehab => $value) {
                    
                     $casaHabitacion = new CasaHabitacion;
                     $casaHabitacion->idCasa = $casa->idCasa;
                     $casaHabitacion->idDetalleHabitacion = $detallehab;
                     $casaHabitacion->save();
                     //insert($habitacion, $detallehab)
                     
                    }
                }    
        }
        //dd($casaHabitacion);
        //dd($vinculos);                     //Obtenemos el num del último grupo registrado.

        $embarazos = $request->get('embarazada');
        $mesesEmbarazo = $request->get('mesesemb');
        $patologias = $request->get('patologia');
        $patologiapersona = $request->get('patologias');
        $escolaridad = $request->get('escolaridad');
        $niveles = $request->get('niveles');
        $vinculos = $request->get('vinculos');
        $generos = $request->get('generos');
        $ocupaciones = $request->get('ocupaciones');
        $situacionesocupacionales = $request->get('situacionesocupacionales');
        $ingresos = $request->get('ingresos');

        $obrasocial = $request->get('obraSociales');
        $instituto = $request->get('insticuciones');
        
        $gruposSocial = $request->get('gruposSocial');
        $programasSociales = $request->get('programasSociales');
        $cantidadSocial = $request->get('cantidadSocial');
        $movimientoSocial = $request->get('movimientoSocial');

        $gruposProvincial = $request->get('gruposProvincial');
        $programasProvinciales = $request->get('programasProvinciales');
        $cantidadProvincial = $request->get('cantidadProvincial');

        
        //dd($embarazos, $mesesEmbarazo, $patologias, $patologiapersona, $escolaridad, $niveles, $vinculos, $generos, $ocupaciones, $situacionesocupacionales, $ingresos, $niveles[0]);
        //dd($obrasocial,$instituto,$gruposSocial,$cantidadSocial,$gruposProvincial,$programasProvinciales,$cantidadProvincial);
        $indice = 1;
        
        //dd($grupos[array_key_last($grupos)]);
        if(!empty($grupos)){
            for ($j=0; $j < $grupos[array_key_last($grupos)]; $j++){
                
                $grupo = new Hogar;
                $grupo->idCasa = $casa->idCasa;
                
                $grupo->save();
                
                //dd($grupo->idCasa);
                //dd($nombres, $apellidos, $dni, $grupo);
                for ($i=0; $i < count($grupos); $i++) {
                   
                    if ($grupos[$i] == $indice){
                        $persona = new Persona;
                        //dd($vinculos, $generos);
                        $persona->idVinculo = $vinculos[$i];
                        $persona->idGenero = $generos[$i];
                        $persona->nombres = $nombres[$i];
                        $persona->apellidos = $apellidos[$i];
                        $persona->fechaNacimiento = $fechaNac[$i];
                        $persona->dni = $dni[$i];   
                        $persona->idhogar = $grupo->idhogar;
                        
                        //dd('hola');
                        //dd($request->get('escolaridad' . strval($i+1))[0],$niveles[$i]);
                        if($request->get('escolaridad' . strval($i+1))[0] != "No" && $niveles[$i] != null && $niveles[$i] != "No"){
                            $persona->idNivel = $niveles[$i];
                        }
                        
                        //dd($situacionesocupacionales[$i]);
                        if($situacionesocupacionales[$i] != null && $situacionesocupacionales[$i] != "No"){
                            $persona->idsituacionOcupacional = $situacionesocupacionales[$i];
                        }
                        
                        $persona->save();                                                
                        
                        if($mesesEmbarazo[$i] != 'No'){
                            if($request->get('embarazada' . strval($i+1))[0] === "Si"){
                                $embarazo = new Embarazo;
                                if($mesesEmbarazo[$i] != null){
                                    $embarazo->mesesEmbarazo = $mesesEmbarazo[$i];
                                }
                                $embarazo->idPersona = $persona->idPersona; 
                                $embarazo->save();
                            }
                        }
                        
                        
                        if($request->get('patologia' . strval($i+1))[0] === "Si" && $patologiapersona[$i] != null){
                            
                            $discapacidad = new Discapacidad;
                            $discapacidad->idPersona = $persona->idPersona;
                            $discapacidad->idPatologia = $patologiapersona[$i];
                            $discapacidad->save();
                        }
                        
                        //dd($ingresos);
                        if($ocupaciones[$i] != null && $ocupaciones[$i] != "No"){
                            $ingreso = new Ingreso;
                            $ingreso->idPersona = $persona->idPersona;
                            $ingreso->idOcupacion = $ocupaciones[$i]; 
                            
                            if($ingresos[$i] != null){
                                $ingreso->monto = $ingresos[$i];
                            }
                            $ingreso->save();
                        } 
                    }
                }
                
                for ($i=0; $i < count($gruposSocial); $i++){

                    if ($gruposSocial[$i] == $indice){
                        $hogarProgramaSocial = new HogarPrograma;
                        
                        $hogarProgramaSocial->cantidad = $cantidadSocial[$i];

                        $hogarProgramaSocial->idPrograma = $programasSociales[$i];
                        
                        $hogarProgramaSocial->idhogar = $grupo->idhogar;
                        //dd($cantidadSocial[$i],$programasSociales[$i],$grupo->idhogar);
                        $hogarProgramaSocial->save();
                    }
                }
                
                for ($i=0; $i < count($gruposProvincial); $i++){

                    if ($gruposSocial[$i] == $indice){
                        $hogarProgramaProvincial = new HogarPrograma;
                        $hogarProgramaProvincial->cantidad = $cantidadProvincial[$i];
                        $hogarProgramaProvincial->idPrograma = $programasProvinciales[$i];
                        $hogarProgramaProvincial->idhogar = $grupo->idhogar;
                        $hogarProgramaProvincial->save();
                    }
                }
                
                $hogarObraSocial= new HogarObraSocial;
                $hogarObraSocial->idhogar = $grupo->idhogar;
                $hogarObraSocial->idObraSocial = $obrasocial[$j];
                $hogarObraSocial->save();
                
                $hogarIntitucionMedica= new HogarInstitucionMedica;
                $hogarIntitucionMedica->idhogar = $grupo->idhogar;
                $hogarIntitucionMedica->idInstitucionMedica = $instituto[$j];
                $hogarIntitucionMedica->save();
                
                $hogarMovimientoSocial = new HogarMovimiento;
                $hogarMovimientoSocial->idMovimientoSocial = $movimientoSocial[$j];
                $hogarMovimientoSocial->idhogar = $grupo->idhogar;
                
                $hogarMovimientoSocial->save();
                
               $indice++;  
            }
        }
        
        

        //Se cambio a esta posición porque innecesariamente asociaba el relevamiento n veces a la misma casa según cuantos grupos pertenecian a la casa.        
        $relevamiento = new Relevamiento;
        $relevamiento->fechaDesde = '2022-06-08';
        $relevamiento->idCasa = $casa->idCasa;
        $relevamiento->estado = 1;
        $relevamiento->save();
        DB::commit();
        return redirect()->route('relevamiento.index');
     }catch (\Exception $e) {
         DB::rollBack();
         //return response()->json(['message' => 'Error']);
         return response();
     }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Relevamiento  $relevamiento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $casa = Casa::join('relevamientos', 'relevamientos.idCasa', '=', 'casas.idCasa')
        ->where('relevamientos.idRelevamiento', $id)
        ->first();

        //dd($casa->numeroCasa);

        $relevamientos = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
            ->join('lotes','lotes.idLote','=', 'casas.idLote')
            ->join('manzana_lotes','manzana_lotes.idLote','=','lotes.idLote')
            ->join('manzanas','manzanas.idManzana','=','manzana_lotes.idManzana')
            ->join('barrio_manzanas','barrio_manzanas.idManzana','=','manzanas.idManzana')
            ->join('barrios','barrios.idBarrio','=','barrio_manzanas.idBarrio')
            ->where('relevamientos.estado', 1)
            ->where('casas.numeroCasa', $casa->numeroCasa)
            ->select('relevamientos.fechaDesde as fechaDesde','barrios.nombre as nombre','manzanas.division as descripcion','lotes.numero as lote','casas.numeroCasa as casa','casas.division as division')
            ->groupBy('casas.division')
            ->get();
            //dd($relevamientos);

            $construcciones = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
            ->join('casasdetalleconstrucciones','casas.idCasa','=', 'casasdetalleconstrucciones.idCasa')
            ->join('detalleconstrucciones','casasdetalleconstrucciones.iddetalleConstruccion','=', 'detalleconstrucciones.iddetalleConstruccion')
            ->join('construcciones','detalleconstrucciones.idConstruccion','=', 'construcciones.idConstruccion')
            ->where('relevamientos.estado', 1)
            ->where('casas.numeroCasa', $casa->numeroCasa)
            ->select('construcciones.nombre as nombrecons','detalleConstrucciones.nombre as nombredetallecons', 'casas.division as division')
            ->get();
            //dd($construcciones);


            $detallecasas = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
            ->join('detallecasa','casas.idCasa','=', 'detallecasa.idCasa')
            ->where('relevamientos.estado', 1)
            ->where('casas.numeroCasa', $casa->numeroCasa)
            ->select('detallecasa.tipoVivienda as tipovivienda','detallecasa.hacinamiento as hacinamiento', 'detallecasa.numeroHabitacion as habitaciones', 'casas.division as division')
            ->get();
            //dd($detallecasa);

            
            $detallehabitaciones = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
            ->join('casahabitaciones','casas.idCasa','=', 'casahabitaciones.idCasa')
            ->join('detallehabitaciones','casahabitaciones.idDetalleHabitacion','=', 'detallehabitaciones.idDetalleHabitacion')
            ->join('habitaciones','detallehabitaciones.idHabitacion','=', 'habitaciones.idHabitacion')
            ->where('relevamientos.estado', 1)
            ->where('casas.numeroCasa', $casa->numeroCasa)
            ->select('habitaciones.nombre as nombrehab', 'detallehabitaciones.nombre as nombredetallehab', 'casas.division as division')
            ->get();
            //dd($detallehabitaciones);


            $personas = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
            ->join('hogares','hogares.idCasa', '=', 'casas.idCasa')
            ->join('personas','hogares.idhogar', '=', 'personas.idhogar')
            ->join('vinculos', 'personas.idVinculo', '=', 'vinculos.idVinculo')
            ->where('relevamientos.estado', 1)
            ->where('casas.numeroCasa', $casa->numeroCasa)
            ->select('personas.nombres as nombres', 'personas.apellidos as apellidos', 'personas.dni as dni', 'personas.fechaNacimiento as fechanac', 'personas.idhogar as hogar', 'vinculos.nombre as vinculo', 'casas.division as division')
            ->get();
            //dd($personas);



        return view('relevamiento.show',['relevamientos'=>$relevamientos, 'construcciones'=>$construcciones, 'detallecasas'=> $detallecasas, 'detallehabitaciones'=> $detallehabitaciones, 'personas'=>$personas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Relevamiento  $relevamiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $relevamiento = $id;

        $hogares = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
        ->join('hogares','hogares.idCasa', '=', 'casas.idCasa')->where('idRelevamiento', $id)->count();
        //dd($hogares);

        $canthogares = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
        ->join('hogares','hogares.idCasa', '=', 'casas.idCasa')->where('idRelevamiento', $id)
        ->groupBy('idhogar')
        ->get();

        //dd($canthogares);

        $casa = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
        ->where('idRelevamiento', $id)
        ->select('casas.numeroCasa')->first();
        //dd($casa);

        $telefono = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
        ->join('telefonos','casas.idCasa','=','telefonos.idCasa')
        ->where('idRelevamiento', $id)
        ->select('telefonos.numero')
        ->first();

        //dd($telefono);
        
        $detallesconsrel = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
        ->join('casasdetalleconstrucciones','casas.idCasa','=','casasdetalleconstrucciones.idCasa')
        ->join('detalleconstrucciones','casasdetalleconstrucciones.iddetalleConstruccion','=','detalleconstrucciones.iddetalleConstruccion')
        ->select('casasdetalleconstrucciones.iddetalleConstruccion', 'detalleConstrucciones.idConstruccion')
        ->where('idRelevamiento', $id)
        ->get();

        //dd($detallesconsrel);

        $detalleshabsrel = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
        ->join('casahabitaciones','casas.idCasa','=','casahabitaciones.idCasa')
        ->join('detallehabitaciones','casahabitaciones.idDetalleHabitacion','=','detallehabitaciones.idDetalleHabitacion')
        ->select('casahabitaciones.idDetalleHabitacion', 'detallehabitaciones.idHabitacion')
        ->where('idRelevamiento', $id)
        ->get();

        //dd($detalleshabsrel);


        $personas = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
        ->join('hogares','casas.idCasa','=','hogares.idCasa')
        ->join('personas','hogares.idhogar','=','personas.idhogar')
        ->join('vinculos', 'personas.idVinculo', '=', 'vinculos.idVinculo') 
        ->select('vinculos.nombre as vinculo', 'personas.nombres', 'personas.apellidos', 'personas.dni', 'personas.fechaNacimiento', 'hogares.idhogar', 'personas.idPersona')
        ->where('idRelevamiento', $id)
        ->get();

        //dd($personas);

        $detallecasa = Relevamiento::join('casas','relevamientos.idCasa','=','casas.idCasa')
        ->join('detallecasa','casas.idCasa','=','detallecasa.idCasa')
        ->select('detallecasa.tipoVivienda', 'detallecasa.hacinamiento', 'detallecasa.numeroHabitacion')
        ->where('idRelevamiento', $id)
        ->first();

        //dd($detallecasa);

        $detalleConstrucciones = DetalleConstruccion::all();
        $detalleHabitaciones = DetalleHabitacion::all();

        $habitaciones = Habitacion::where('estado', 1)
        ->whereIn('idHabitacion', DetalleHabitacion::select('idHabitacion'))          //Para controlar que no devuelva una habitacion sin detalles de habitacion registrados.
        ->get();

        $construcciones = Construccion::where('estado', 1)
        ->whereIn('idConstruccion', DetalleConstruccion::select('idConstruccion'))          //Para controlar que no devuelva una construcción sin detalles de construccion registrados.
        ->get();
        
        //dd($construcciones);
        return view('relevamiento.edit',compact('detalleConstrucciones','construcciones','habitaciones','detalleHabitaciones', 'casa', 'telefono', 'detallesconsrel', 'hogares', 'canthogares', 'detallecasa', 'detalleshabsrel', 'personas', 'relevamiento'));
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
        $casa = Casa::join('relevamientos','casas.idCasa','=','relevamientos.idCasa')
        ->where('idRelevamiento', $id)
        ->first();
        //dd($casa);

        $casa->numeroCasa = $request->get('casa');
        $casa->update();


        //Telefono es int, controlar tipo y rango. Falla al superar su rango.
        $telefono = Telefono::join('casas','telefonos.idCasa','=','casas.idCasa')
        ->join('relevamientos','casas.idCasa','=','relevamientos.idCasa')
        ->where('idRelevamiento', $id)
        ->first();
        //dd($telefono);
        
        $telefono->numero = $request->get('telefono');
        $telefono->update();
        
        $casasdetallecons = CasaDetalleConstruccion::join('casas','casasdetalleconstrucciones.idCasa','=','casas.idCasa')
        ->join('relevamientos','casas.idCasa','=','relevamientos.idCasa')
        ->where('idRelevamiento', $id)
        ->get();

        $detallesconstruccion = DetalleConstruccion::get()->toArray();
        $detallesconstruccion =  array_column($detallesconstruccion, 'iddetalleConstruccion');

        $arreglodetallecons = $casasdetallecons->toArray();
        $arreglodetallecons = array_column($arreglodetallecons, 'iddetalleConstruccion');

        $detallescons = $request->get('detallecons');

        //Tipo Construcción y Servicio

        //Insertar aquellos checkeados.

        $arreglodetallesrel = [];
        if(!empty($detallescons)){
        foreach ($detallescons as $construccion => $valor) {
            foreach ($valor as $detallecons => $value) {
                if(!in_array($detallecons, $arreglodetallecons)){
                    $casadetalleconstruccion = new CasaDetalleConstruccion;
                    $casadetalleconstruccion->idCasa =  $casa->idCasa;
                    $casadetalleconstruccion->iddetalleConstruccion = $detallecons;
                    $casadetalleconstruccion->save();
                }
                $arreglodetallesrel[] = $detallecons;
            }
        }
        }

        //Borrar aquellos que no fueron checkeados.

        for($i = 0; $i < count($arreglodetallecons); $i++){
            if(!in_array($arreglodetallecons[$i], $arreglodetallesrel)){
                $casasdetallecons->where('iddetalleConstruccion', $arreglodetallecons[$i])->first()->delete();
            }
        }

        //Organización Vivienda

        $detallecasa = DetalleCasa::join('casas', 'detallecasa.idCasa', '=', 'casas.idCasa')
        ->join('relevamientos', 'casas.idCasa', '=', 'relevamientos.idCasa')
        ->where('idRelevamiento', $id)
        ->first();


        //Tipo Vivienda

        if(empty($request->get('tipoVivienda'))){
            $detallecasa->tipoVivienda = 0;
        } else {
            $detallecasa->tipoVivienda = 1;
        }

        $detallecasa->numeroHabitacion = $request->get('numeroHabitacion');
        
        if(empty($request->get('hacinamiento'))){
            $detallecasa->hacinamiento = 0;
        } else {
            $detallecasa->hacinamiento = 1;
        }
    
        $detallecasa->update();

        //Habitaciones
        $casasdetallehab = CasaHabitacion::join('casas','casahabitaciones.idCasa','=','casas.idCasa')
        ->join('relevamientos','casas.idCasa','=','relevamientos.idCasa')
        ->where('idRelevamiento', $id)
        ->get();

        $detalleshabitacion = DetalleHabitacion::get()->toArray();
        $detalleshabitacion =  array_column($detalleshabitacion, 'idDetalleHabitacion');

        //Creamos el arreglo para verificar si los checkeados ya estan en bd y evitar duplicados.
        $arreglodetallehab = $casasdetallehab->toArray();
        $arreglodetallehab = array_column($arreglodetallehab, 'idDetalleHabitacion');


        $detalleshab = $request->input('detallehab');
        //Creamos un arreglo para los checkeados y comprobar si pertenecen a un DetalleHabitacion.
        $arreglodetallesrel2 = [];
        
        
        if(!empty($detalleshab)){
             foreach ($detalleshab as $habitacion => $valor) {
                
                 foreach ($valor as $detallehab => $value) {
                    if(!in_array($detallehab, $arreglodetallehab)){         //Comprobamos.
                     $casaHabitacion = new CasaHabitacion;
                     $casaHabitacion->idCasa = $casa->idCasa;
                     $casaHabitacion->idDetalleHabitacion = $detallehab;
                     $casaHabitacion->save();                     
                    }
                    $arreglodetallesrel2[] = $detallehab;
                }    
            }
         }

        //Borrar aquellos que no fueron checkeados.

        for($i = 0; $i < count($arreglodetallehab); $i++){
            if(!in_array($arreglodetallehab[$i], $arreglodetallesrel2)){    //Comprobamos si pertenece, si no, se elimina.
                $casasdetallehab->where('idDetalleHabitacion',$arreglodetallehab[$i])->first()->delete();
            }
        }

        $identificadores = $request->get('id');
        $hogares = $request->get('hogar');
        $grupohogar = $request->get('grupohogar');
        $grupos = $request->get('grupos');
        $vinculos = $request->get('vinculos');
        $nombres = $request->get('nombres');
        $apellidos = $request->get('apellidos');
        $fechaNac = $request->get('fechaNac');
        $dni = $request->get('dni');

        //Grupos Personas
        $indice = 1;
        if(!empty($grupos)){
            for ($j=0; $j < count($grupohogar); $j++){
                if($grupohogar[$j] == "no"){
                    $grupo = new Hogar;
                    $grupo->idCasa = $casa->idCasa;
                    $grupo->save();
                } 
                for ($i=0; $i < count($grupos); $i++) {
                    if ($grupos[$i] == $indice && $identificadores[$i] == "no"){
                        $persona = new Persona;
                        $persona->vinculo = $vinculos[$i];
                        $persona->nombres = $nombres[$i];
                        $persona->apellidos = $apellidos[$i];
                        $persona->fechaNacimiento = '2022-06-08';
                        $persona->dni = $dni[$i];
                        $persona->ocupacion = 'maestro';
                        if($hogares[$i] == "no"){
                            $persona->idhogar = $grupo->idhogar;
                        } else{
                            $persona->idhogar = $hogares[$i];
                        }
                        $persona->save();
                    }
                }
                $indice++;  
            }
        }

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
