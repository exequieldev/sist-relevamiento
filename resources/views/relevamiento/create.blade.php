@extends('adminlte::page')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sd-12 col-xs-12">
      <h3>Nuevo Relevamiento</h3>
      @if(count($errors)>0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
              @endforeach
          </ul>
      </div>
      @endif

    <form action={{url('/relevamiento')}} method="POST" autocomplete="off">
          @csrf
          <div class="row">
            <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                <label for="barrio">Barrio</label>
                <select name="barrio" class="form-control">
                    <option>Seleccionar...</option>
                    @foreach ($barrios as $barrio)
                        <option value="{{$barrio->idBarrio}}">{{$barrio->nombre}}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                <label for="manzana">Manzana</label>
                <select name="manzana" class="form-control">
                    <option>Seleccionar...</option>
                    @foreach ($manzanas as $manzana)
                        <option value="{{$manzana->idManzana}}">{{$manzana->descripcion}}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                <label for="lote">Lote</label>
                <select name="lote" class="form-control">
                    <option>Seleccionar...</option>
                    @foreach ($lotes as $lote)
                        <option value="{{$lote->idLote}}">{{$lote->numero}}</option>
                    @endforeach
                </select>
              </div>
                <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                    <div class="form-group">
                        <label for="casa">Casa N°</label>
                        <input type="text" name="casa" class="form-control" placeholder="Ingrese numero de la casa">
                    </div>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                    <div class="form-group">
                        <label for="numeroTelefono">Numero Telefono</label>
                        <input type="number" name="telefono" class="form-control" placeholder="Ingrese el numero de telefono">
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
                            <input  type="checkbox" name="detallecons[{{$construccion->idConstruccion}}][{{$detalleConstruccion->iddetalleConstruccion}}]">
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
                            <input  type="checkbox" name="" id="">
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">N° Habitacion</label>
                            <input style="width: 50px" type="number" name="" id="">
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">Hacinamiento</label>
                            <input  type="checkbox" name="" id="">
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
                                            <input  type="checkbox" name="detallehab[{{$habitacion->idHabitacion}}][{{$detalleHabitacion->idHabitacion}}]">
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
                        
                    </div>
                </div>
                
            </div>
          
          <div class="form-group">
              <button class="btn btn-primary" type="submit">Guardar</button>
              <button class="btn btn-danger" type="reset">Cancelar</button>
          </div>
    </form>

  </div> 
</div>
  
<script>
incrementador = 1;

document.getElementById("btn_accordion").addEventListener("click", function(event){
  event.preventDefault();
  crearAcordeon();
});

function crearAcordeon(){
    //Cabecera 
    acordion  = '<div class="card">';
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
    acordion = acordion + '<thead>' + '<tr><th scope="col">#</th>' + '<th scope="col">Vinculo</th>' + '<th scope="col">Nombres</th>' +  '<th scope="col">Aperllidos</th>' + ' <th scope="col">Fecha Nacimiento</th>' + '<th scope="col">Dni</th>' + '<th scope="col">Operaciones</th>' + ' </tr>' + ' </thead>' + '<tbody id="tablebody' + incrementador + '">' + '</tbody>' + '</table>' + ' </div>' + ' </div>';
    acordion = acordion + '</div>' + '</div>' + '</div>';

  
    $("#accordionExample").append(acordion);
    incrementador++;

}

function agregar(inc){
    console.log(inc);
    vinculo = $("#vinculo" + inc).val();
    nombres = $("#nombres" + inc).val();
    apellidos = $("#apellidos" + inc).val();
    dni = $("#dni" + inc).val();
    fechaNac = $("#fechaNac" + inc).val();

    if (vinculo != "" && nombres != "" && apellidos != "" && dni != "" && fechaNac != ""){
                var fila = '<tr>';
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
