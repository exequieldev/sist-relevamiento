@extends('adminlte::page')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sd-12 col-xs-12">
      <h3>Editar Relevamiento</h3>
      @if(count($errors)>0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
              @endforeach
          </ul>
      </div>
      @endif

    <form action={{url('/relevamiento/'.$relevamiento)}} method="POST" autocomplete="off">
          @method('put')
          @csrf
          <div class="row">
        {{-- <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                <label for="barrio">Barrio</label>
                <select name="barrio" class="form-control">
                    <option>Seleccionar...</option>
                    @foreach ($barrios as $barrio)
                        <option value="{{$barrio->idBarrio}}">{{$barrio->nombre}}</option>
                    @endforeach
                </select>
              </div> --}}

               
                <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                    <div class="form-group">
                        <label for="casa">Casa N°</label>
                        <input type="text" name="casa" class="form-control" value="{{$casa->numeroCasa}}" placeholder="Ingrese numero de la casa">
                    </div>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                    <div class="form-group">
                        <label for="barrios">Barrio</label>
                        
                        <select class="form-control" name="barrios" id="">
                        <option {{$relevamientosGeneral->barrioId}}>{{$relevamientosGeneral->nombre}}</option>
                        @foreach ($barrios as $barrio)
                            <option value={{$barrio->idBarrio}}>{{$barrio->nombre}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                    <div class="form-group">
                        <label for="barrios">Manzana</label>
                        
                        <select class="form-control" name="numeroManzana" id="">
                        <option value={{$relevamientosGeneral->manzanaId}}>{{$relevamientosGeneral->manzanaNumero}}</option>
                        @foreach ($manzanas as $manzana)
                            <option value={{$manzana->idManzana}}>{{$manzana->numero}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                    <div class="form-group">
                        <label for="divisionManzana">Letra Manzana</label>
                        
                        <select class="form-control" name="divisionManzana" id="">
                        <option value={{$relevamientosGeneral->manzanaId}}>{{$relevamientosGeneral->manzanaDivision}}</option>
                        @foreach ($manzanas as $manzana)
                            <option value={{$manzana->idManzana}}>{{$manzana->division}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                    <div class="form-group">
                        <label for="numeroTelefono">Numero Telefono</label>
                        <input type="text" name="telefono" class="form-control" value="{{$telefono->numero}}" placeholder="Ingrese el numero de telefono">
                    </div>
                </div>
          </div>
          
          <h5>Tipo de Construccion y Servicio</h5>
          <div class="row mb-3 ml-1" style="width: 75%;">
            @foreach ($construcciones as $construccion)
            <ul class="list-group">
            <h5>{{$construccion->nombre}}</h5>
            
            @foreach ($detalleConstrucciones as $detalleConstruccion)
                    @if($construccion->idConstruccion == $detalleConstruccion->idConstruccion)
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">{{$detalleConstruccion->nombre}}</label>
                        @php
                            $existe = false;
                        @endphp
                            @foreach($detallesconsrel as $detalleconsrel)
                                @if($detalleConstruccion->iddetalleConstruccion == $detalleconsrel->iddetalleConstruccion && $construccion->idConstruccion == $detalleconsrel->idConstruccion)
                                    <input  type="checkbox" name="detallecons[{{$construccion->idConstruccion}}][{{$detalleConstruccion->iddetalleConstruccion}}]" checked>
                                    @php
                                        $existe = true;
                                    @endphp                                    
                                @endif
                            @endforeach
                            @if($existe == false)
                                <input  type="checkbox" name="detallecons[{{$construccion->idConstruccion}}][{{$detalleConstruccion->iddetalleConstruccion}}]">
                            @endif
                            </li>
                    @endif
                @endforeach
            </ul>
            @endforeach
            
          </div>

           <h5>Organizacion de Vivienda</h5>
            <div class="row mt-3" >
                <div class="form-group col-lg-3 col-md-3 col-sd-3 col-xs-3">
                    <ul class="list-group ">
                        <h5>Tipo Vivienda</h5>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">Compartida</label>
                            @if($detallecasa->tipoVivienda == 1)
                                <input  type="checkbox" name="tipoVivienda" id="" value="1" checked>
                            @else
                                <input  type="checkbox" name="tipoVivienda" id="" value="1">
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">N° Habitacion</label>
                            <input style="width: 50px" type="number" name="numeroHabitacion" id="" value="{{$detallecasa->numeroHabitacion}}">
                        </li>
                        
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">Hacinamiento</label>
                            @if($detallecasa->hacinamiento == 1)
                                <input  type="checkbox" name="hacinamiento" id="" checked>
                            @else
                                <input  type="checkbox" name="hacinamiento" id="">
                            @endif
                        </li>
                    </ul>
                </div>
                 <div class="form-group col-lg-8 col-md-8 col-sd-8 col-xs-8">
                    <div class="form-group row">
                        @foreach ($habitaciones as $habitacion)
                            <ul class="list-group">
                            <h5>{{$habitacion->nombre}}</h5>
                            @foreach ($detalleHabitaciones as $detalleHabitacion)
                                    @if($habitacion->idHabitacion == $detalleHabitacion->idHabitacion )
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-0 pl-2 pr-2"  style="width: 250px;">
                                        <label class="pr-2" for="">{{$detalleHabitacion->nombre}}</label>
                                        @php
                                            $existe = false;
                                        @endphp
                                        @foreach($detalleshabsrel as $detallehabsrel)
                                             @if($detalleHabitacion->idDetalleHabitacion == $detallehabsrel->idDetalleHabitacion && $habitacion->idHabitacion == $detallehabsrel->idHabitacion)
                                                <input  type="checkbox" name="detallehab[{{$habitacion->idHabitacion}}][{{$detalleHabitacion->idDetalleHabitacion}}]" checked>
                                                @php
                                                    $existe = true;
                                                @endphp   
                                            @endif
                                        @endforeach

                                        @if($existe == false)
                                            <input  type="checkbox" name="detallehab[{{$habitacion->idHabitacion}}][{{$detalleHabitacion->idDetalleHabitacion}}]">
                                        @endif    
                                        </li>
                                    @endif
                            @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div> 
                
            </div>
            <h5>Datos Grupo Familiar</h5>
            <div class="row mb-3 ">
                <div class="col-lg-3 col-md-3 col-sd-3 col-xs-3 mb-3">
                    <button class="form-control" id="btn_accordion">Nuevo Grupo</button>
                </div>

                <div class="col-lg-12 col-md-12 col-sd-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sd-12 col-xs-12 p-0">
                        <div class="accordion" id="accordionExample">
                        @php
                            $incrementador = 1;
                        @endphp
                        @foreach($canthogares as $hogar)    
                            <div class="card">
                                <input type="hidden" name="grupohogar[]" value="{{$hogar->idhogar}}">
                                <div class="card-header" id="headingOne{{$incrementador}}">
                                    <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne{{$incrementador}}" aria-expanded="true" aria-controls="collapseOne{{$incrementador}}">Grupo Familiar {{$incrementador}} </button> </h2>
                                </div>

                            <div id="collapseOne{{$incrementador}}" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                     <div class="row">

                                     <!-- Vinculo -->
                                        <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                                            <div class="form-group"><label for="casa">Vinculo</label>
                                                 <input type="text" id="vinculo{{$incrementador}}" class="form-control" placeholder="Ingrese vinculo">
                                            </div>    
                                        </div>

                                    <!-- Nombres -->
                                        <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                                            <div class="form-group">
                                                <label for="nombres">Nombres</label>
                                                <input type="text" id="nombres{{$incrementador}}" class="form-control" placeholder="Ingrese nombres">
                                            </div>
                                        </div>

                                    <!-- Apellidos -->
                                    <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                                        <div class="form-group"><label for="apellidos">Apellidos</label>
                                            <input type="text" id="apellidos{{$incrementador}}" class="form-control" placeholder="Ingrese apellidos">
                                        </div>
                                    </div>

                                    <!-- Fecha Nacimiento -->
                                    <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                                        <div class="form-group">
                                            <label for="fechaNac">Fecha Nacimiento</label>
                                            <input type="text" id="fechaNac{{$incrementador}}" class="form-control" placeholder="Ingrese Fecha Nacimiento">
                                        </div>
                                    </div>

                                    <!-- DNI -->
                                    <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                                        <div class="form-group"><label for="dni">DNI</label>
                                            <input type="text" id="dni{{$incrementador}}" class="form-control" placeholder="Ingrese DNI">   
                                        </div>
                                    </div>

                                    <!-- Botón -->
                                    <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                                        <div class="form-group">
                                            <label for="" style="visibility:hidden">Agregar Persona</label>
                                             <button class="form-control" id="btn_add" onclick="agregar({{$incrementador}}, {{$hogar->idhogar}}), event.preventDefault()">Agregar Persona</button>
                                        </div>
                                    </div>

                                    <!-- Tabla -->
                                    <div class="row table-responsive">
                                        <div class="table-responsive">
                                            <table class="col-sm-12 table-bordered table-striped table-condensed ">
                                                <thead>
                                                <tr><th scope="col">#</th>
                                                <th scope="col">Vinculo</th>
                                                <th scope="col">Nombres</th>
                                                <th scope="col">Apellidos</th>
                                                <th scope="col">Fecha Nacimiento</th>
                                                <th scope="col">DNI</th>
                                                <th scope="col">Operaciones</th>
                                                </tr>
                                                </thead>
                                            <tbody id="tablebody{{$incrementador}}">
                                            @foreach($personas as $persona)
                                            @if($persona->idhogar == $hogar->idhogar)
                                            <tr>
                                                <td> 
                                                <input type="hidden" name="id[]" value="{{$persona->idPersona}}">
                                                <input type="hidden" name="hogar[]" value="{{$persona->idhogar}}">
                                                <input type="hidden" name="grupos[]" value="{{$incrementador}}"></td>
                                                <td><input type="hidden" name="vinculos[]" value="{{$persona->vinculo}}">{{$persona->vinculo}}</td>
                                                <td><input type="hidden" name="nombres[]" value="{{$persona->nombres}}">{{$persona->nombres}}</td>
                                                <td><input type="hidden" name="apellidos[]" value="{{$persona->apellidos}}}}">{{$persona->apellidos}}</td>
                                                <td><input type="hidden" name="dni[]" value="{{$persona->dni}}">{{$persona->fechaNacimiento}}</td>
                                                <td><input type="hidden" name="fechaNac[]" value="{{$persona->fechaNacimiento}}">{{$persona->dni}}</td>
                                                <td>
                                                <button class="form-control">
                                                Detalle
                                                </button>
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    @php
                            $incrementador++;
                    @endphp
                    @endforeach
                </div>
                
            </div>
          
          <div class="form-group">
              <button class="btn btn-primary" type="submit">Actualizar</button>
              <button class="btn btn-danger" type="reset">Cancelar</button>
          </div>
    </form>

  </div> 
</div>
  
<script>
incrementador = parseInt("{!! $hogares !!}") + 1;

document.getElementById("btn_accordion").addEventListener("click", function(event){
  event.preventDefault();
  crearAcordeon();
});

function crearAcordeon(){
    //Cabecera 
    acordion  = '<div class="card">';
    acordion =  acordion + '<input type="hidden" name="grupohogar[]" value="no">';
    acordion =  acordion + '<div class="card-header" id="headingOne "' + incrementador + '">';
    acordion  =  acordion + '<h2 class="mb-0">';
    acordion = acordion + '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne' + incrementador + '" aria-expanded="true" aria-controls="collapseOne' + incrementador + '">Grupo Familiar ' + incrementador + ' </button> </h2>';
    acordion = acordion + '</div>';

    //Contenido 
    acordion = acordion + '<div id="collapseOne' + incrementador + '" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">';
    acordion = acordion + '<div class="card-body">' + ' <div class="row">';
    
    //Vinculo 
    acordion = acordion + '<div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">';
    acordion = acordion + '<div class="form-group">' + '<label for="casa">Vinculo</label>';
    acordion = acordion + '<input type="text" id="vinculo' + incrementador + '" class="form-control" placeholder="Ingrese vinculo">' + '</div>' + '</div>';

    //Nombres
    acordion = acordion + '<div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">';
    acordion = acordion + '<div class="form-group">' + '<label for="nombres">Nombres</label>';
    acordion = acordion + '<input type="text" id="nombres' + incrementador + '" class="form-control" placeholder="Ingrese nombres">' + '</div>' + '</div>';

    //Apellidos
    acordion = acordion + '<div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">';
    acordion = acordion + '<div class="form-group">' + '<label for="apellidos">Apellidos</label>';
    acordion = acordion + '<input type="text" id="apellidos' + incrementador + '" class="form-control" placeholder="Ingrese apellidos">' + '</div>' + '</div>';

    //Fecha Nacimiento
    acordion = acordion + '<div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">';
    acordion = acordion + '<div class="form-group">' + '<label for="fechaNac">Fecha Nacimiento</label>';
    acordion = acordion + '<input type="text" id="fechaNac' + incrementador + '" class="form-control" placeholder="Ingrese Fecha Nacimiento">' + '</div>' + '</div>';


    //DNI
    acordion = acordion + '<div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">';
    acordion = acordion + '<div class="form-group">' + '<label for="dni">DNI</label>';
    acordion = acordion + '<input type="text" id="dni' + incrementador + '" class="form-control" placeholder="Ingrese DNI">' + '</div>' + '</div>' ;

    //Boton
    acordion = acordion + '<div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">';
    acordion = acordion + '<div class="form-group">';
    acordion = acordion + '<label for="" style="visibility:hidden">Agregar Persona</label>';
    acordion = acordion + '<button class="form-control" id="btn_add" onclick="agregar(' + incrementador + '), event.preventDefault()">Agregar Persona</button>';
    acordion = acordion + '</div>' + '</div>';


    //Tabla
    
    acordion = acordion + '<div class="row table-responsive">';
    acordion = acordion + '<div class="table-responsive">';
    acordion = acordion + '<table class="col-sm-12 table-bordered table-striped table-condensed ">';
    acordion = acordion + '<thead>' + '<tr><th scope="col">#</th>' + '<th scope="col">Vinculo</th>' + '<th scope="col">Nombres</th>' +  '<th scope="col">Apellidos</th>' + ' <th scope="col">Fecha Nacimiento</th>' + '<th scope="col">DNI</th>' + '<th scope="col">Operaciones</th>' + ' </tr>' + ' </thead>' + '<tbody id="tablebody' + incrementador + '">' + '</tbody>' + '</table>' + ' </div>' + ' </div>';
    acordion = acordion + '</div>' + '</div>' + '</div>';

  
    $("#accordionExample").append(acordion);
    incrementador++;

}

function agregar(inc, hogar = null){
    console.log(inc);
    vinculo = $("#vinculo" + inc).val();
    nombres = $("#nombres" + inc).val();
    apellidos = $("#apellidos" + inc).val();
    dni = $("#dni" + inc).val();
    fechaNac = $("#fechaNac" + inc).val();

    if (vinculo != "" && nombres != "" && apellidos != "" && dni != "" && fechaNac != ""){
                var fila = '<tr>';
                fila = fila + '<input type="hidden" name="id[]" value="no">';
                if(hogar != null){
                    fila = fila + '<input type="hidden" name="hogar[]" value="'+hogar+'" >';
                } else {
                    fila = fila + '<input type="hidden" name="hogar[]" value="no" >';
                }
                
                fila = fila + '<td>' + '<input type="hidden" name="grupos[]" value="'+inc+'">'+'</td>';
                fila = fila + '<td><input type="hidden" name="vinculos[]" value="' + vinculo + '">' + vinculo + '</td>' ;
                fila = fila + '<td><input type="hidden" name="nombres[]" value="' + nombres + '">' + nombres + '</td>' ;
                fila = fila + '<td><input type="hidden" name="apellidos[]" value="' + apellidos + '">' + apellidos + '</td>' ;
                fila = fila + '<td><input type="hidden" name="fechaNac[]" value="' + fechaNac + '">' + fechaNac + '</td>' ;
                fila = fila + '<td><input type="hidden" name="dni[]" value="' + dni + '">' + dni + '</td>' ;
                fila = fila + '<td>' + '<button class="form-control">'+ 'Detalle' + '</button>' + '</td>' ;
                fila = fila + '</tr>' ;
                limpiar(inc);

                $("#tablebody" + inc).append(fila) ;

} else {
    alert("Error al ingresar los datos de la persona en el grupo familiar.") ;
}
}

function limpiar(inc){
    $("#vinculo" + inc).val("");
    $("#nombres" + inc).val("");
    $("#apellidos" + inc).val("");
    $("#fechaNac" + inc).val("");
    $("#dni" + inc).val("");
}
</script>
@stop
